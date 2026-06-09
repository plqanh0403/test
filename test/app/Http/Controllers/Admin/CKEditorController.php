<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request, string $folder, MediaService $mediaService)
    {
        if (!$request->hasFile('upload')) {
            return response()->json([
                'error' => [
                    'message' => 'No file uploaded.'
                ]
            ], 400);
        }

        $path = $mediaService->uploadImg($request->file('upload'), $folder);

        return response()->json([
            'url' => Storage::url($path)
        ]);
    }
}
