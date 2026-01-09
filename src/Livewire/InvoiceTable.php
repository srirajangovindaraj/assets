<?php

namespace Bfree\AssetManagement\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Bfree\AssetManagement\Models\Invoice;
class InvoiceTable extends Component
{
    use WithPagination;
    public $search = "";

    public function render()
    {
        $search = $this->search;

        $invoices = Invoice::with('vendor')
            ->when($search, function ($query) use ($search) {
                $query->where('invoice_number', 'like', '%' . $search . '%')
                      ->orWhereHas('vendor', function ($q) use ($search) {
                          $q->where('company_name', 'like', '%' . $search . '%');
                      });
            })
            ->orderBy('id','desc')
            ->paginate(7);

        return view('assetsmanagement::livewire.invoice-table', compact('invoices'));
    }
}
