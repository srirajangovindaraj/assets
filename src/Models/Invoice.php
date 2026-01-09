<?php

// namespace App\Models;
namespace Bfree\AssetManagement\Models;

use App\Traits\CommentAndAttachment as TraitsCommentAndAttachment;
use Illuminate\Database\Eloquent\Model;

use Bfree\AssetManagement\Traits\CommentAndAttachment;

class Invoice extends Model
{
use CommentAndAttachment;

    protected $casts = [
    'due_date' => 'date', //convert into carbon data
    'invoice_date' => 'date',

];
    protected $fillable = [
        'vendor_id',
        'invoice_number',
        'invoice_date',
        'sub_total',
        'category',
        'partial_amount',
        'due_date',
        'tax_amount',
        'discount_type',
        'discount_percentage',
        'discount_amount',
        'total_amount',
        'invoice_file_path',
        'status',
        'created_by',
        'updated_by',
    ];
     public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

     public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
      public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
                    ->latest();
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable')
                    ->latest();
    }
    public function auditLogs()
{
    return $this->morphMany(AuditLog::class, 'auditlogable');
}

public function allAuditLogs()
{
    return collect()
        ->merge($this->auditLogs)
        ->merge($this->Items->flatMap->auditLogs)
        ->merge($this->Items->flatMap->assets->flatMap->auditLogs)
        ->sortByDesc('created_at')
        ->values();
}


    
}
