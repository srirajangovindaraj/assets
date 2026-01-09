<?php

namespace Bfree\AssetManagement\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Bfree\AssetManagement\Models\Vendor;


class VendorTable extends Component
{
    use WithPagination;
    public  $search="";

    public function render()
    {
         $vendors=Vendor::Where('company_name','like','%'.$this->search.'%')->orwhere('email','like','%'.$this->search . '%')
         ->orderBy('id','desc')->paginate(7);
        return view('assetsmanagement::livewire.vendor-table',compact('vendors'));
    }
}
