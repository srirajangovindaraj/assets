<?php

namespace Bfree\AssetManagement\Traits;

use App\Models\Comment;
use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait CommentAndAttachment
{


    public function addComment($text, $user_id = null)
    {
        return $this->comments()->create([
            // 'user_id' => $user_id ?? auth()->id(),
            'comment' => $text,
        ]);
    }

public function addAttachment(array $data)
{
    // dd($data); 

    return $this->attachments()->create([
        'original_filename' => $data['original_filename'],
        's3_filename'       => $data['s3_filename'],
        'mime_type'         => $data['mime_type'],
        'file_type'         => $data['file_type'],
        // 'added_by'          => $data['added_by'] ?? auth()->id(),
    ]);
}

}
