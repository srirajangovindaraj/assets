<?php

namespace Bfree\AssetManagement\Livewire;

use Livewire\Component;
use Bfree\AssetManagement\Models\Invoice;
use Bfree\AssetManagement\Models\Asset;
use Bfree\AssetManagement\Models\AuditLog;

class LogTable extends Component
{
    public $auditlog;      
    public $context = 'invoice';
    public $assetId = null;

    public $invoice;
    public $asset;

    public $auditlogs = [];
    public $type = 'all';

    public function mount($auditlog, $context = 'invoice')
    {
        $this->auditlog = $auditlog;
        $this->context = $context;

        if ($this->context === 'invoice') {
            $this->loadInvoiceLogs();
        }

        if ($this->context === 'asset') {
            $this->loadAssetLogs();
        }
    }

    protected function loadInvoiceLogs()
    {
        $this->invoice = Invoice::with([
            'auditLogs',
            'items.auditLogs',
            'items.assets.auditLogs',
        ])->findOrFail($this->auditlog);

        $logs = $this->invoice->allAuditLogs();

        $logs = $logs->reject(function ($log) {
            return $log->comments === 'Assigned asset updated';
        });

        if ($this->type !== 'all') {
            $logs = $logs->filter(fn ($log) =>
                class_basename($log->auditlogable_type) === $this->type
            );
        }

        $this->auditlogs = $logs;
    }

    protected function loadAssetLogs()
    {
        $this->auditlogs = AuditLog::where('auditlogable_type', \Bfree\AssetManagement\Models\Asset::class)
        ->where('auditlogable_id', $this->auditlog) 
        ->where('comments', 'LIKE', '%Asset%updated%')
        ->get(); 
    }

    public function updatedType()
    {
        if ($this->context === 'invoice') {
            $this->loadInvoiceLogs();
        }
    }

    public function render()
    {
        return view('assetsmanagement::livewire.log-table');
    }
}
