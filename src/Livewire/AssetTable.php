<?php

namespace Bfree\AssetManagement\Livewire;

use Livewire\Component;
use Bfree\AssetManagement\Models\Asset;

use Livewire\WithPagination;

class AssetTable extends Component
{
    public $search="";
    use WithPagination;

   public function render()
{
    $assets = Asset::with(['invoiceItem.invoice'])
        ->where(function ($query) {
            $query->where('asset_code', 'like', '%' . $this->search . '%')
                  ->orWhere('status', 'like', '%' . $this->search . '%')
                  ->orWhereHas('invoiceItem.invoice', function ($q) {
                      $q->where('invoice_number', 'like', '%' . $this->search . '%');
                  });
        })
        ->orderBy('id', 'desc')
        ->paginate(7);

    return view('assetsmanagement::livewire.asset-table', compact('assets'));
}

}
