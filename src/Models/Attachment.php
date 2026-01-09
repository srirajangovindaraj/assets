<?php

// namespace App\Models;
namespace Bfree\AssetManagement\Models; 


use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['user_id', 'file_path', 'original_filename','s3_filename','mime_type','file_type','added_by',];

    public function attachable()
    {
        return $this->morphTo();
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
