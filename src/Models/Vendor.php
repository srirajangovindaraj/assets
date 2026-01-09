<?php

// namespace App\Models;
namespace Bfree\AssetManagement\Models; 

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
     protected $fillable = [
       'company_name',
        'contact_person_name',
        'email',
        'website',
        'flat_no',
        'street',
        'area',
        'city',
        'district',
        'state',
        'pin',
        'landmark',
        'mobile_nbr',
        'landline_nbr',
        'pan_no',
        'gst_no',
        'adhar_no',
        'is_active',
    ];
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
