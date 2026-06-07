<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('upload')) {
            return response()->json([
                'error' => [
                    'message' => 'No file uploaded.'
                ]
            ], 400);
        }

        $file = $request->file('upload');

        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/editor'), $filename);

        $url = asset('uploads/editor/' . $filename);

        return response()->json([
            'url' => $url
        ]);
    }
}
