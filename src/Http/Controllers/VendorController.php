<?php

namespace Bfree\AssetManagement\Http\Controllers;

use Bfree\AssetManagement\Models\Invoice; 
use Bfree\AssetManagement\Models\Vendor; 

use Illuminate\Http\Request;

class VendorController extends Controller
{
       public function vendor(){
       
        $vendors=vendor::all();
return view('assetsmanagement::assetsmanagement.vendors.index', compact('vendors'));
   }
    public function vendorcreate(){
      return view('assetsmanagement::assetsmanagement.vendors.create');
   }

 public function vendorstore(Request $request)
{
    $validated = $request->validate(
    [
        'company_name'        => 'required|string|max:255',
        'contact_person_name' => 'nullable|string|max:255',
        'email'               => 'required|email',
        'mobile_nbr'          => 'required|digits:10',
        'website'             => 'nullable|url',

        'flat_no'   => 'nullable|string|max:100',
        'street'    => 'nullable|string|max:255',
        'area'      => 'nullable|string|max:255',
        'city'      => 'nullable|string|max:255',
        'district'  => 'nullable|string|max:255',
        'state'     => 'nullable|string|max:255',
        'pin'       => 'nullable|digits:6',
        'landmark'  => 'nullable|string|max:255',
        'gst_no'    => ['nullable','regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z][1-9A-Z]Z[0-9A-Z]$/'],
        'pan_no'    => ['nullable','required_without:adhar_no','regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/'],
        'adhar_no' => ['nullable','required_without:pan_no','digits:12'
        ],
    ],
    [
        'pan_no.required_without'   => 'PAN or Aadhaar is required.',
        'adhar_no.required_without' => 'PAN or Aadhaar is required.',
    ]
);


    // Duplicate vendor check
    if (Vendor::where('company_name', $request->company_name)->exists()) {
        return back()->with('error', 'Vendor name already exists.');
    }
    
    $vendor = Vendor::create($validated);

    return redirect()->route('asset-management.index')
        ->with('success', 'Vendor created successfully');
}

  
    public function vendoredit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('assetsmanagement::assetsmanagement.vendors.edit', compact('vendor'));
    }


    public function vendorupdate(Request $request, $id)
{
    // dd($request);
    $vendor = Vendor::findOrFail($id);

   $validated = $request->validate([
    'company_name'        => 'required|string|max:255',
    'contact_person_name' => 'nullable|string|max:255',
    'email'               => 'required|email',
    'mobile_nbr'          => 'required|digits:10',

    'flat_no'   => 'nullable|string|max:100',
    'street'    => 'nullable|string|max:255',
    'area'      => 'nullable|string|max:255',
    'city'      => 'nullable|string|max:255',
    'district'  => 'nullable|string|max:255',
    'state'     => 'nullable|string|max:255',
    'pin'       => 'nullable|digits:6',
    'landmark'  => 'nullable|string|max:255',

    'gst_no' => ['nullable', 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z][1-9A-Z]Z[0-9A-Z]$/'],
    'pan_no' => ['nullable', 'required_without:adhar_no', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/'],
    'adhar_no' => ['nullable', 'required_without:pan_no', 'digits:12'],
], [
    'pan_no.required_without'   => 'PAN or Aadhaar is required.',
    'adhar_no.required_without' => 'PAN or Aadhaar is required.',
]);


    if (
        Vendor::where('company_name', $request->company_name)->where('id', '!=', $id)->exists()
    ) {
        return back()->with('error', 'Vendor name already exists.');
    }

    $vendor->update($validated);

    return redirect()->route('asset-management.index')
        ->with('success', 'Vendor updated successfully');
}


    public function vendordetails($id){
        $vendor = Vendor::findOrFail($id);
        return view('assetsmanagement::assetsmanagement.vendors.show',compact('vendor'));
    }

   public function destroy($id)
{
    $vendor = Vendor::findOrFail($id);
    $vendor->delete();

    return redirect()->route('asset-management.index')->with('success', 'Vendor deleted successfully.');
}

}
