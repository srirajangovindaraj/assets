<?php

namespace Bfree\AssetManagement\Http\Controllers;

use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'file'       => 'required|file|max:5120',
            'file_type'  => 'required|in:invoice,products,other',
            'model_type' => 'required|string',
            'model_id'   => 'required|integer',
        ]);
        // dd($validated);

        $modelClass = $request->model_type;
        $model = $modelClass::findOrFail($request->model_id);

        $file = $request->file('file');
        $originalFilename = $file->getClientOriginalName();
        $mimeType = $file->getClientMimeType();

        $s3Filename = $file->store('attachments', 'public');

        $model->addAttachment([
            'original_filename' => $originalFilename,
            's3_filename'       => $s3Filename,
            'mime_type'         => $mimeType,
            'file_type'         => $request->file_type,
        ]);

        return back()->with('success', 'File uploaded successfully');

    } catch (\Throwable $e) {
        return back()->with('error', $e->getMessage());
    }
}


}
