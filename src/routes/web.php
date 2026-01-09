<?php

use Illuminate\Support\Facades\Route;
use Bfree\AssetManagement\Http\Controllers\HomeController;
use Bfree\AssetManagement\Http\Controllers\VendorController;
use Bfree\AssetManagement\Http\Controllers\InvoiceController;
use Bfree\AssetManagement\Http\Controllers\AssetsController;
use Bfree\AssetManagement\Http\Controllers\AttachmentController;
use Bfree\AssetManagement\Http\Controllers\CommentController;

// All package routes under this group to avoid conflicts

Route::group(['prefix' => 'asset-management', 'as' => 'asset-management.'], function () {
    // Home / Dashboard 
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // Vendor Routes
    Route::middleware(['web'])->group(function () {
    Route::get('/', [VendorController::class, 'vendor'])->name('index');
    Route::get('/vendor/create', [VendorController::class, 'vendorcreate'])->name('vendor.create');
    Route::post('/vendor', [VendorController::class, 'vendorstore'])->name('vendor.store');
    Route::get('/vendor/{id}', [VendorController::class,'vendordetails'])->name('vendor.details');
    Route::get('/vendor/edit/{id}', [VendorController::class,'vendoredit'])->name('vendor.edit');
    Route::put('/vendor/{id}', [VendorController::class, 'vendorupdate'])->name('vendor.update');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');

    Route::get('/invoice', [InvoiceController::class, 'invoice'])->name('invoice.index');
    Route::get('/invoice/create', [InvoiceController::class,'invoicecreate'])->name('invoice.create');
    Route::get('/vendors/search', [InvoiceController::class,'vendorSearch'])->name('invoice.search');
    Route::post('/invoice', [InvoiceController::class,'invoicestore'])->name('invoice.store');
    Route::get('/invoice/edit/{id}', [InvoiceController::class,'invoiceedit'])->name('invoice.edit');
    Route::get('/invoice/{id}', [InvoiceController::class,'invoiceshow'])->name('invoice.show');
    Route::put('/invoice/{id}', [InvoiceController::class,'invoiceupdate'])->name('invoice.update');
    Route::delete('/invoice/{id}', [InvoiceController::class,'destroy'])->name('invoice.destroy');
    Route::get('/invoice/{id}/logs', [InvoiceController::class,'logs'])->name('invoice.log');

    // Assets Routes
    Route::get('/assets', [AssetsController::class, 'assets'])->name('assets.index');
    Route::get('/assets/edit/{id}', [AssetsController::class, 'assetsedit'])->name('assets.edit');
    Route::get('/assets/{id}', [AssetsController::class,'assetsshow'])->name('assets.show');
    Route::put('/assets/{id}', [AssetsController::class, 'assetsupdate'])->name('assets.update'); 
    Route::get('/assets/{item}/{category}', [AssetsController::class,'show'])->name('assets.productshow');
    Route::delete('/assets/{id}', [AssetsController::class,'destroy'])->name('assets.destroy');
    Route::get('/asset/{id}/logs', [AssetsController::class,'logs'])->name('assets.log');

    // Comments and Attachments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/attachments', [AttachmentController::class, 'store'])->name('attachments.store');
});
});