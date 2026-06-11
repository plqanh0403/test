@extends('admin.layout')

@section('content')

<x-admin.page-header title="Media Library" description="Manage uploaded images, videos and files">
</x-admin.page-header>

<x-admin.search-box :route="route('admin.media')" placeholder="Search file by name...">

    <x-admin.filter-box box_name="Type" select_name='is_visible'>
        <option value="">
            -- Select --
        </option>

        <option value="1" {{ request('type') === 'image' ? 'selected' : '' }}>
            Images
        </option>

        <option value="0" {{ request('type') === 'video' ? 'selected' : '' }}>
            Videos
        </option>

        <option value="0" {{ request('type') === 'document' ? 'selected' : '' }}>
            Documents
        </option>

        <option value="0" {{ request('type') === 'other' ? 'selected' : '' }}>
            Other
        </option>
    </x-admin.filter-box>

</x-admin.search-box>

<div class="media-library-layout">

    {{-- Upload Panel --}}
    <div class="upload-panel">

        <form action="{{ route('admin.media.store') }}"  method="POST" enctype="multipart/form-data" id="uploadForm">

            @csrf

            <div class="dropzone" id="dropzone">

                <i class="bi bi-cloud-arrow-up-fill"></i>

                <h3>Drop files here</h3>

                <p>or click to browse</p>

                <input type="file" id="mediaInput" name="files[]" multiple hidden>

            </div>

            <div id="previewArea"></div>

            <button
                class="btn btn-primary w-100 mt-3">

                Upload Files

            </button>

        </form>

    </div>

    {{-- Media Library --}}
    <div class="library-panel">

        <div class="media-grid">

            @foreach($media as $item)

                <div class="media-card">

                    @if($item->type === 'image')

                        <img src="{{ Storage::url($item->path) }}">

                    @else

                        <div class="media-file">

                            <i class="bi bi-file-earmark"></i>

                        </div>

                    @endif

                    <div class="media-info">

                        <strong>
                            {{ $item->original_name }}
                        </strong>

                        <small>
                            {{ number_format($item->size / 1024,1) }} KB
                        </small>

                    </div>

                    <div class="media-actions">

                        <button class="btn btn-view" data-bs-toggle="modal" data-bs-target="#mediaModal{{ $item->id }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </button>

                        <button class="btn btn-edit copy-url" data-url="{{ Storage::url($item->path) }}">
                            <i class="bi bi-copy"></i>
                        </button>

                        <form action="{{ route('admin.media.destroy',$item) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this file?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </form>

                    </div>

                </div>

                @include('admin.media.partials.detail')

            @endforeach

        </div>

        <div class="mt-4">
            {{ $media->links() }}
        </div>

    </div>

</div>
@endsection
