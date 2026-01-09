<?php

namespace Bfree\AssetManagement\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'comment'    => 'required|string',
                'model_type' => 'required|string',
                'model_id'   => 'required|integer',
            ]);

            $model = $request->model_type::findOrFail($request->model_id);

            $model->addComment($request->comment);

            return back()->with('success', 'Comment added successfully');

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
