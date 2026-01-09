<?php

// namespace App\Models;
namespace Bfree\AssetManagement\Models; 


use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
   protected $fillable = [
         'invoice_id',
        'product_name',
        'quantity',
        'price',
        'amount',
        'created_by',
        'updated_by',
    ];
     public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
    
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditlogable');
    }
}
