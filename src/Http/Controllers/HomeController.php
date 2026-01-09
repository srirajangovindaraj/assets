<?php

namespace Bfree\AssetManagement\Http\Controllers;
use Illuminate\Routing\Controller;

use Bfree\AssetManagement\Models\Vendor;
use Bfree\AssetManagement\Models\Invoice;
use Bfree\AssetManagement\Models\InvoiceItem;
use Bfree\AssetManagement\Models\Asset;

use Illuminate\Http\Request;



class HomeController extends Controller
{
   public function index(){
      $assets= Asset::all();
      $vendor= Vendor::all();
      $invoice = Invoice::all();
      $totalAmount = $invoice->sum('total_amount');
      
return view('assetsmanagement::assetsmanagement.dashboard', compact('assets','vendor','invoice','totalAmount'));
   }
   // public function vendor(){
   //    return view('assetsmanagement.vendors.index');
   // }
   // public function vendorstore(Request $request){
   //    dd($request->all);
   // }
   // public function vendorcreate(){
   //    return view('assetsmanagement.vendors.create');
   // }
   // public function assets(){
   //            $assets = Asset::get();

   //      return view('assetsmanagement.asset.index', compact('assets'));

   // }
   // public function assetscreate(){
   //    return view('assetsmanagement.asset.create');
   // }
   // public function invoice(){
   //    return view ('assetsmanagement.invoice.index');
   // }
   // public function invoiceitems(){
   //    return view ('assetsmanagement.invoice.invoice-items');
   // }
   // public function invoicecreate(){
   //    return view ('assetsmanagement.invoice.create');
   // }
   // public function invoicestore(Request $request){
    
   // }
}
