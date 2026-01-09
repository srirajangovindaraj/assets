<?php

// namespace App\Models;

namespace Bfree\AssetManagement\Models; 
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
         'invoice_item_id',
        'asset_code',
        'status',
        'warranty_start_date',
        'warranty_end_date',
        'assigned_to',
        'assigned_by',
        'updated_by',
    ];
    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }
    
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditlogable');
    }
    
}
