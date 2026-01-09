<?php

namespace Bfree\AssetManagement\Http\Controllers;

use Illuminate\Http\Request;

use Bfree\AssetManagement\Models\Invoice;
use Bfree\AssetManagement\Models\Asset;
use Bfree\AssetManagement\Models\Vendor;
use Bfree\AssetManagement\Models\User;
use Bfree\AssetManagement\Models\InvoiceItem;




class AssetsController extends Controller
{
    public function assets(){
        return view('assetsmanagement::assetsmanagement.asset.index');
    }
  public function assetsEdit($id)
    {
        // dd($id);
        $asset = Asset::findOrFail($id);
        $users = User::all();
        $vendors = Vendor::all();

        return view('assetsmanagement::assetsmanagement.asset.edit', compact('asset', 'users', 'vendors'));
    }

    public function assetsUpdate(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'status'      => 'required|string|in:active,repair,assigned',
            'assigned_to' => 'nullable|exists:users,id', 
        ]);

        $asset = Asset::findOrFail($id);
        $oldAsset = $asset->getOriginal();

        $asset->update([
            'status'      => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

         if ($changes = $asset->getChanges()) {
        $asset->auditLogs()->create([
            'event'      => 'updated',
            'old_values' => array_intersect_key($oldAsset, $changes),
            'new_values' => $changes,
            'comments'   => 'Asset updated',
        ]);
    }
    return redirect()->route('asset-management.assets.index')->with('success', 'Asset updated successfully.');
    }
    public function assetsshow($id){
        $assets= Asset::findOrFail($id);
        return view('assetsmanagement::assetsmanagement.asset.show',compact('assets'));
    }

     public function destroy($id)
    {
        $invoice = Asset::findOrFail($id);
        $invoice->delete();
        return redirect()
            ->route('asset-management.assets.index')
            ->with('success', 'Invoice deleted successfully.');
    }

public function logs($id)
{
    // dd($id);
    return view('assetsmanagement::assetsmanagement.asset.auditlog', [
        'asset' => Asset::findOrFail($id),
    ]);
}

    public function show($id)
{
    // dd($id);
    $assets = InvoiceItem::where('invoice_id', $id)->get();
    // dd($assets);
    return view('assetsmanagement::assetsmanagement.asset.invoice-item', compact('assets'));
}

}
