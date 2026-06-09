<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    public function uploadImg(UploadedFile $file, string $folder): Media {

        $filename = time() . '_' . Str::random(8) . '.' . $file->extension();

        $path = $file->storeAs("images/{$folder}", $filename, 'public');

        return Media::create([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'url' => Storage::url($path),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'type' => 'image',
            'folder' => $folder,
            'uploaded_by' => Auth::id(),
        ]);
    }

    public function uploadFile(UploadedFile $file, string $folder, $type): Media {

        $filename = time() . '_' . Str::random(8) . '.' . $file->extension();

        $path = $file->storeAs($folder, $filename, 'public');

        return Media::create([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'url' => Storage::url($path),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'type' => $type,
            'folder' => $folder,
            'uploaded_by' => Auth::id(),
        ]);
    }
}
