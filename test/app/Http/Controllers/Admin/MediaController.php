<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query()
            ->with('user');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('original_name', 'like', "%{$request->search}%");

            });
        }

        if ($request->filled('type')) {

            $query->where('type', $request->type);

        }

        $media = $query->with(['user'])
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('admin.media.index', compact('media'));
    }


    public function store(Request $request, MediaService $mediaService)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'file|max:10240'
        ]);

        foreach ($request->file('files') as $file) {

            $mime = $file->getMimeType();

            if (str_starts_with($mime, 'image/')) {
                $type = 'image';
            } elseif (str_starts_with($mime, 'video/')) {
                $type = 'video';
            } elseif (
                str_contains($mime, 'pdf') ||
                str_contains($mime, 'word') ||
                str_contains($mime, 'sheet')
            ) {
                $type = 'document';
            } else {
                $type = 'other';
            }

            $mediaService->uploadFile(
                $file,
                'media',
                $type
            );
        }

        return back()->with(
            'success',
            'Upload successful'
        );
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->path);

        $media->delete();

        return back()->with('success', 'Media deleted successfully');
    }
}
