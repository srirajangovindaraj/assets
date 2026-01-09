<?php

namespace Bfree\AssetManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AssetManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'assetsmanagement');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../resources/views' =>
                resource_path('views/vendor/assetsmanagement'),

            __DIR__ . '/../../database/migrations' =>
                database_path('migrations'),
        ], 'asset-management');

      

            Livewire::component('invoice-table', \Bfree\AssetManagement\Livewire\InvoiceTable::class);
            Livewire::component('asset-table', \Bfree\AssetManagement\Livewire\AssetTable::class);
            Livewire::component('vendor-table', \Bfree\AssetManagement\Livewire\VendorTable::class);
            Livewire::component('log-table', \Bfree\AssetManagement\Livewire\LogTable::class);

    }

}
