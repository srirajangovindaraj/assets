<?php

// namespace App\Models;
namespace Bfree\AssetManagement\Models; 


use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $guarded = [];
    protected $casts = [
        'old_values' =>'array',
        'new_values' =>'array',

    ];

     public function auditlogable()
    {
        return $this->morphTo();
    }
}
