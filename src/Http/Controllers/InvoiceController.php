<?php

namespace Bfree\AssetManagement\Http\Controllers;

use Illuminate\Http\Request;
use Bfree\AssetManagement\Models\Invoice;
use Bfree\AssetManagement\Models\Vendor;

use Bfree\AssetManagement\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;
use Bfree\AssetManagement\Models\Asset;
use Bfree\AssetManagement\Models\AuditLog;
use Illuminate\Support\Carbon;

class InvoiceController extends Controller
{
    public function invoice()
    {
        $invoices = Invoice::with('vendor')->latest()->get();
        return view('assetsmanagement::assetsmanagement.invoice.index', compact('invoices'));
    }

    public function invoicecreate(Request $request)
    {
        $vendors = Vendor::all();
        return view('assetsmanagement::assetsmanagement.invoice.create', compact('vendors'));
    }

    public function vendorSearch(Request $request)
    {
        $query = $request->input('q');

        $vendors = Vendor::where('company_name', 'LIKE', "%{$query}%")
            ->select('id', 'company_name')
            ->limit(10)
            ->get();

        return response()->json($vendors);
    }

   public function invoiceStore(Request $request)
    {
        // dd($request);
        $request->validate([
            'vendor_id'        => 'required|exists:vendors,id',
            'invoice_number'   => 'required|string|max:255|unique:invoices,invoice_number',
            'invoice_date'     => 'required|date',
            'status'           => 'required|in:unpaid,paid,partial_paid',
            'category'         => 'required|string|max:255',

            'items.*.product_name' => 'required|string|max:255|distinct',
            'items.*.qty'          => 'required|integer|min:1',
            'items.*.price'        => 'required|numeric|min:0',

            'sub_total'     => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        if (($request->partial_amount ?? 0) > $request->total_amount) {
            return back()
                ->withInput()
                ->with('error', 'Partial amount cannot exceed total amount.');
        }

        $invoiceDate = Carbon::parse($request->invoice_date);
        $dueDate     = $request->due_date ? Carbon::parse($request->due_date) : null;

        if ($dueDate && $dueDate->lt($invoiceDate)) {
            return back()
                ->withInput()
                ->with('error', 'Due Date cannot be earlier than Invoice Date.');
        }

        DB::beginTransaction();

        try {
            $invoice = Invoice::create([
                'vendor_id'           => $request->vendor_id,
                'invoice_number'      => $request->invoice_number,
                'invoice_date'        => $request->invoice_date,
                'status'              => $request->status,
                'category'            => $request->category,
                'sub_total'           => $request->sub_total,
                'discount_amount'     => $request->discount_amount ?? 0,
                'discount_percentage' => $request->discount_percentage ?? 0,
                'tax_amount'          => $request->tax_amount ?? 0,
                'partial_amount'      => $request->partial_amount ?? 0,
                'total_amount'        => $request->total_amount,
                'due_date'            => $request->due_date,
            ]);
            $invoice->auditLogs()->create([
    'event'      => 'created',
    'old_values' => null,
    'new_values' => $invoice->toArray(),
    'comments'   => 'Invoice created',
]);


            foreach ($request->items as $index => $item) {
                $invoiceItem = InvoiceItem::create([
                    'invoice_id'   => $invoice->id,
                    'product_name' => $item['product_name'],
                    'quantity'     => $item['qty'],
                    'price'        => $item['price'],
                    'amount'       => $item['qty'] * $item['price'],
                ]);
                $invoiceItem->auditLogs()->create([
                        'event'      => 'created',
                        'old_values' => null,
                        'new_values' => $invoiceItem->toArray(),
                        'comments'   => 'Invoice item created',
                ]);

                if (!empty($request->items_serials[$index])) {
                    foreach ($request->items_serials[$index] as $i => $serial) {
                        $asset=$invoiceItem->assets()->create([
                            'asset_code'          => $serial,
                            'warranty_start_date' => $request->invoice_date,
                            'warranty_end_date'   => $request->warranty_end_date[$index][$i] ?? null,
                        ]);

$asset->auditLogs()->create([
    'event'      => 'created',
    'old_values' => null,
    'new_values' => $asset->toArray(),
    'comments'   => 'Asset created for invoice item',
]);
                    }
                }
                

            }

            DB::commit();

            return redirect()
                ->route('asset-management.invoice.index')
                ->with('success', 'Invoice created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Failed to create invoice. ' . $e->getMessage());
        }
    }
    public function invoiceedit($id)
    {
        $invoice = Invoice::with(['items', 'items.assets'])->findOrFail($id);
        $vendors = Vendor::all();

        return view('assetsmanagement::assetsmanagement.invoice.edit', compact('invoice', 'vendors'));
    }


public function invoiceUpdate(Request $request, $id)
{
    $request->validate([
        'vendor_id'            => 'required|exists:vendors,id',
        'invoice_number'       => 'required|string|max:255',
        'invoice_date'         => 'required|date',
        'status'               => 'required|in:unpaid,paid,partial_paid',
        'category'             => 'required|string|max:255',
        'items.*.product_name' => 'required|string|max:255',
        'items.*.qty'          => 'required|integer|min:1',
        'items.*.price'        => 'required|numeric|min:0',
        'sub_total'            => 'required|numeric|min:0',
        'total_amount'         => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();

    try {

        $invoice = Invoice::with('items.assets')->findOrFail($id);
        $oldInvoice = $invoice->getOriginal();

        $invoice->update([
            'vendor_id'           => $request->vendor_id,
            'invoice_number'      => $request->invoice_number,
            'invoice_date'        => $request->invoice_date,
            'status'              => $request->status,
            'category'            => $request->category,
            'sub_total'           => $request->sub_total,
            'discount_amount'     => $request->discount_amount ?? 0,
            'discount_percentage' => $request->discount_percentage ?? 0,
            'tax_amount'          => $request->tax_amount ?? 0,
            'partial_amount'      => $request->partial_amount,
            'total_amount'        => $request->total_amount,
            'due_date'            => $request->due_date,
        ]);

       if ($changes = $invoice->getChanges()) {
    $invoice->auditLogs()->create([
        'event'      => 'updated',
        'old_values' => array_intersect_key($oldInvoice, $changes), // use $invoice, not $asset
        'new_values' => $changes,
        'comments'   => 'Invoice updated',
    ]);
}



        foreach ($request->items as $index => $itemData) {

            if (!empty($itemData['id'])) {
                $item = InvoiceItem::find($itemData['id']);

                $oldItem = $item->getOriginal();

                $updateData = [
                'product_name' => $itemData['product_name'],
                'quantity'     => $itemData['qty'],
                'price'        => $itemData['price'],
            ];
            if (
                $itemData['qty'] != $item->quantity ||
                $itemData['price'] != $item->price
            ) {
                $updateData['amount'] = $itemData['qty'] * $itemData['price'];
            }

            $item->update($updateData);

                if ($itemChanges = $item->getChanges()) {
                    $item->auditLogs()->create([
                        'event'      => 'updated',
                        'old_values' => array_intersect_key($oldItem, $itemChanges),
                        'new_values' => $itemChanges,
                        'comments'   => 'Invoice item updated',
                    ]);
                }
            }
            if (!empty($request->items_serials[$index])) {

                foreach ($request->items_serials[$index] as $i => $assetCode) {

                    $assetId = $request->existing_assets[$index][$i] ?? null;

                    if ($assetId) {
                        $asset = Asset::find($assetId);

                        $oldAsset = $asset->getOriginal();

                        $asset->update([
                            'asset_code'          => $assetCode,
                            'warranty_start_date' => $request->invoice_date,
                            'warranty_end_date'   => $request->warranty_end_date[$index][$i] ?? null,
                        ]);

                        if ($assetChanges = $asset->getChanges()) {
                            $asset->auditLogs()->create([     
                                'event'      => 'updated',
                                'old_values' => array_intersect_key($oldAsset, $assetChanges),
                                'new_values' => $assetChanges,
                                'comments'   => 'Asset updated',
                            ]);
                        }

                    }
                }
            }
        }

        DB::commit();

        return redirect()
            ->route('asset-management.invoice.index')
            ->with('success', 'Invoice updated successfully');

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to update invoice. ' . $e->getMessage());
    }
}


    public function invoiceshow($id)
    {
        $invoice = Invoice::with(['vendor', 'items'])->findOrFail($id);
        return view('assetsmanagement::assetsmanagement.invoice.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()
            ->route('asset-management.invoice.index')
            ->with('success', 'Invoice deleted successfully.');
    }


 public function logs($id)
{
    return view('assetsmanagement::assetsmanagement.auditlog', [
        'auditlog' => $id
    ]);
}

}