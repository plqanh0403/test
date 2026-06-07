@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Blog Management"
    description="Manage all blogs in the system">

    <x-slot:action>
        <a href="{{ route('admin.categories') }}" class="btn blue d-flex align-items-center justify-content-center">
            Category Management
        </a>

        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createBlogModal">
            + Create Blog
        </button>
    </x-slot:action>

</x-admin.page-header>

<div class="blog-tabs">

    <a href="{{ route('admin.blogs', ['type' => 'tech-service']) }}" class="blog-tab {{ $type == 'tech-service' ? 'active' : '' }}">
        <i class="bi bi-cpu-fill"></i>
        Technical Services
        <span>{{ $servicesCount }}</span>
    </a>

    <a href="{{ route('admin.blogs', ['type' => 'EGEAD-activity']) }}" class="blog-tab {{ $type == 'EGEAD-activity' ? 'active' : '' }}">
        <i class="bi bi-calendar-event-fill"></i>
        E-GEAD Activities
        <span>{{ $activitiesCount }}</span>
    </a>

</div>

<x-admin.search-box :route="route('admin.blogs', ['type' => $type])" placeholder="Title or excerpt...">

    <x-admin.filter-box box_name="Category" select_name='category_id'>
        <option value="">-- Select --</option>

        @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </x-admin.filter-box>

    <x-admin.filter-box box_name="Status" select_name='status'>
        <option value="">-- Select --</option>

        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
            Published
        </option>

        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>
            Draft
        </option>
    </x-admin.filter-box>

</x-admin.search-box>

<table class="index-table">
    <thead class="table-header">
        <tr>
            <th width="50">Order</th>
            <th>Title</th>
            <th>Excerpt</th>
            <th>Category</th>
            <th>Status</th>
            <th width="215">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->sort_order }}</td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->excerpt }}</td>
            <td>{{ $blog->category?->name }}</td>
            <td>
                @if($blog->status === 'draft')
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                    Draft
                </span>
                @else
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                    Published
                </span>
                @endif
            </td>

            <td>
                <button class="btn btn-view" data-bs-toggle="modal" data-bs-target="#detailBlogModal{{ $blog->id }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </button>

                <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this blog?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>

                @if($blog->is_visible)
                <form action="{{ route('admin.blogs.hide', $blog->id) }}" method="POST" class="inline-block">

                    @csrf
                    @method('PUT')

                    <button class="btn btn-lock px-3 py-1 rounded" onclick="return confirm('Hide this blog?')">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </form>
                @else
                <form action="{{ route('admin.blogs.show', $blog->id) }}" method="POST" class="inline-block">

                    @csrf
                    @method('PUT')

                    <button class="btn btn-unlock px-3 py-1 rounded" onclick="return confirm('Show this blog?')">
                        <i class="bi bi-eye-slash-fill"></i>
                    </button>
                </form>
                @endif
            </td>
        </tr>

        <!-- Detail Blog Modal -->
        <div class="modal fade" id="detailBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">

                        <div class="d-flex align-items-center gap-4">

                            <div class="modal-icon bg-primary-subtle text-primary">

                                <i class="bi bi-journal-richtext"></i>

                            </div>

                            <div>

                                <h2 class="fw-bold mb-2">
                                    {{ $blog->title }}
                                </h2>

                                <div class="d-flex gap-2 flex-wrap">

                                    <span class="badge bg-info">
                                        {{ $blog->type }}
                                    </span>

                                    <span class="badge
                            {{ $blog->status == 'published'
                                ? 'bg-success'
                                : 'bg-warning text-dark' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>

                                    <span class="badge
                            {{ $blog->is_visible
                                ? 'bg-primary'
                                : 'bg-secondary' }}">
                                        {{ $blog->is_visible ? 'Visible' : 'Hidden' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <!-- Thumbnail -->
                        @if($blog->thumbnail)

                        <div class="admin-card mb-4">

                            <img src="{{ asset($blog->thumbnail) }}"
                                class="img-fluid rounded-4 w-100"
                                style="max-height:350px;object-fit:cover;">

                        </div>

                        @endif

                        <!-- Overview -->
                        <div class="row g-4 mb-4">

                            <div class="col-md-3">

                                <div class="admin-card h-100">

                                    <small class="text-muted">
                                        Category
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        {{ $blog->category->name ?? 'No Category' }}
                                    </h6>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="admin-card h-100">

                                    <small class="text-muted">
                                        Sort Order
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        #{{ $blog->sort_order }}
                                    </h6>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="admin-card h-100">

                                    <small class="text-muted">
                                        Published At
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d M Y') : '-' }}
                                    </h6>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="admin-card h-100">

                                    <small class="text-muted">
                                        Author
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        {{ $blog->user->name ?? '-' }}
                                    </h6>

                                </div>

                            </div>

                        </div>

                        <!-- Slug -->
                        <div class="admin-card mb-4">

                            <h6 class="admin-card-title">
                                Slug
                            </h6>

                            <code>
                                {{ $blog->slug }}
                            </code>

                        </div>

                        <!-- Excerpt -->
                        <div class="admin-card mb-4">

                            <h6 class="admin-card-title">
                                Excerpt
                            </h6>

                            <p class="mb-0">
                                {{ $blog->excerpt ?? '-' }}
                            </p>

                        </div>

                        <!-- SEO -->
                        <div class="row g-4 mb-4">

                            <div class="col-md-6">

                                <div class="admin-card h-100">

                                    <h6 class="admin-card-title">
                                        SEO Title
                                    </h6>

                                    <p class="mb-0">
                                        {{ $blog->seo_title ?? '-' }}
                                    </p>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="admin-card h-100">

                                    <h6 class="admin-card-title">
                                        SEO Description
                                    </h6>

                                    <p class="mb-0">
                                        {{ $blog->seo_description ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- Content -->
                        <div class="admin-card mb-4">

                            <h6 class="admin-card-title">
                                Content
                            </h6>

                            <div class="blog-content-preview">

                                {!! $blog->content !!}

                            </div>

                        </div>

                        <!-- Dates -->
                        <div class="row g-4">

                            <div class="col-md-6">

                                <div class="admin-card">

                                    <small class="text-muted">
                                        Created At
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        {{ $blog->created_at ? \Carbon\Carbon::parse($blog->created_at)->format('d M Y') : '-' }}
                                    </h6>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="admin-card">

                                    <small class="text-muted">
                                        Updated At
                                    </small>

                                    <h6 class="fw-bold mt-2">
                                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d M Y') : '-' }}
                                    </h6>

                                </div>

                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end mt-4">

                            <button class="btn btn-warning text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#editBlogModal{{ $blog->id }}">

                                <i class="bi bi-pencil-square me-2"></i>
                                Edit Blog

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Edit Blog Modal -->
        <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">

                <div class="modal-content admin-modal">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">

                        <div>
                            <h3 class="fw-bold mb-1">
                                Create Blog
                            </h3>

                            <p class="text-muted mb-0">
                                Create and publish a new article.
                            </p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <!-- LEFT -->
                                <div class="col-lg-8 d-flex">

                                    <div class="admin-card content-card flex-grow-1">

                                        <!-- TITLE -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Blog Title
                                            </label>

                                            <input type="text" name="title" class="form-control admin-input" value="{{ old('title', $blog->title) }}" placeholder="Enter blog title..." required>

                                        </div>

                                        <!-- EXCERPT -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Excerpt
                                            </label>

                                            <textarea name="excerpt" rows="4" class="form-control admin-input" placeholder="Short description..." required>{{ $blog->excerpt }}</textarea>

                                        </div>

                                        <!-- CONTENT -->
                                        <div class="editor-wrapper">

                                            <label class="form-label fw-semibold">
                                                Content
                                            </label>

                                            <textarea name="content" class="form-control ckeditor">{{ $blog->content }}</textarea>

                                        </div>

                                    </div>

                                </div>

                                <!-- RIGHT -->
                                <div class="col-lg-4">

                                    <!-- PUBLISH -->
                                    <div class="admin-card mb-4">

                                        <h6 class="admin-card-title">
                                            Publish
                                        </h6>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Status
                                            </label>

                                            <select name="status" class="form-select">
                                                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                                                    Draft
                                                </option>

                                                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                                                    Published
                                                </option>
                                            </select>

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Visibility
                                            </label>

                                            <select name="is_visible" class="form-select">
                                                <option value="1" {{ old('is_visible', $blog->is_visible) == '1' ? 'selected' : '' }}>
                                                    Visible
                                                </option>

                                                <option value="0" {{ old('is_visible', $blog->is_visible) == '0' ? 'selected' : '' }}>
                                                    Hidden
                                                </option>
                                            </select>

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Publish Date
                                            </label>

                                            <input type="datetime-local" value="{{ old('published_at', $blog->published_at) }}" name="published_at" class="form-control">

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Sort Order
                                            </label>

                                            <input type="number" name="sort_order" value="0" class="form-control">

                                        </div>

                                    </div>

                                    <!-- CATEGORY -->
                                    <div class="admin-card mb-4">

                                        <h6 class="admin-card-title">
                                            Classification
                                        </h6>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Category
                                            </label>

                                            <select name="category_id" class="form-select">
                                                 <option value="{{ $blog->category_id }}">{{ $blog->category->name ?? '-- Select category --' }}</option>

                                                @foreach($categories as $category)

                                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Type
                                            </label>

                                            <select name="type" class="form-select">

                                                <option value="tech-service" {{ old('type', $blog->type) == 'tech-service' ? 'selected' : '' }}>
                                                    Tech Service
                                                </option>

                                                <option value="EGEAD-activity" {{ old('type', $blog->type) == 'EGEAD-activity' ? 'selected' : '' }}>
                                                    EGEAD Activity
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- THUMBNAIL -->
                                    <div class="admin-card mb-4">

                                        <h6 class="admin-card-title">
                                            Thumbnail
                                        </h6>

                                        <div class="mb-3">

                                            <input type="file" name="thumbnail" class="form-control">

                                        </div>

                                        <input type="text" name="thumbnail_alt" value="{{ old('thumbnail_alt', $blog->thumbnail_alt) }}" class="form-control" placeholder="Thumbnail alt text...">

                                    </div>

                                    <!-- SEO -->
                                    <div class="admin-card">

                                        <h6 class="admin-card-title">
                                            SEO Settings
                                        </h6>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                SEO Title
                                            </label>

                                            <input type="text" name="seo_title" value="{{ old('seo_title', $blog->seo_title) }}" class="form-control">

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                SEO Description
                                            </label>

                                            <textarea name="seo_description" rows="4" class="form-control">{{ $blog->seo_description }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="d-flex justify-content-end gap-2 mt-4">

                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit" class="btn btn-primary px-4">
                                    Update Blog
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        @endforeach
    </tbody>
</table>

<div class="mt-4 d-flex justify-content-center">
    {{ $blogs->links() }}
</div>

<!-- CREATE BLOG MODAL -->
<div class="modal fade" id="createBlogModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>
                    <h3 class="fw-bold mb-1">
                        Create Blog
                    </h3>

                    <p class="text-muted mb-0">
                        Create and publish a new article.
                    </p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8 d-flex">

                            <div class="admin-card content-card flex-grow-1">

                                <!-- TITLE -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Blog Title
                                    </label>

                                    <input type="text" required name="title" class="form-control admin-input" value="{{ old('title') }}" placeholder="Enter blog title..." required>

                                </div>

                                <!-- EXCERPT -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Excerpt
                                    </label>

                                    <textarea name="excerpt" rows="4" class="form-control admin-input" placeholder="Short description..." required>{{ old('excerpt') }}</textarea>

                                </div>

                                <!-- CONTENT -->
                                <div class="editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Content
                                    </label>

                                    <textarea name="content" class="form-control ckeditor">{{ old('content') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <!-- PUBLISH -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Publish
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select name="status" class="form-select" required>
                                        <option value="draft">
                                            Draft
                                        </option>

                                        <option value="published">
                                            Published
                                        </option>
                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Visibility
                                    </label>

                                    <select name="is_visible" class="form-select">
                                        <option value="1">
                                            Visible
                                        </option>

                                        <option value="0">
                                            Hidden
                                        </option>
                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Publish Date
                                    </label>

                                    <input type="datetime-local" name="published_at" class="form-control">

                                </div>

                                <div>

                                    <label class="form-label">
                                        Sort Order
                                    </label>

                                    <input type="number" name="sort_order" value="0" class="form-control">

                                </div>

                            </div>

                            <!-- CATEGORY -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Classification
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Category
                                    </label>

                                    <select name="category_id" class="form-select">
                                        <option value="">
                                            -- Select Category --
                                        </option>

                                        @foreach($categories as $category)

                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>

                                        @endforeach

                                    </select>

                                </div>

                                <div>

                                    <label class="form-label">
                                        Type
                                    </label>

                                    <select name="type" class="form-select" required>

                                        <option value="tech-service">
                                            Tech Service
                                        </option>

                                        <option value="EGEAD-activity">
                                            EGEAD Activity
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- THUMBNAIL -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Thumbnail
                                </h6>

                                <div class="mb-3">

                                    <input type="file" name="thumbnail" class="form-control" required>

                                </div>

                                <input type="text" name="thumbnail_alt" class="form-control" placeholder="Thumbnail alt text...">

                            </div>

                            <!-- SEO -->
                            <div class="admin-card">

                                <h6 class="admin-card-title">
                                    SEO Settings
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        SEO Title
                                    </label>

                                    <input type="text" name="seo_title" class="form-control">

                                </div>

                                <div>

                                    <label class="form-label">
                                        SEO Description
                                    </label>

                                    <textarea name="seo_description" rows="4" class="form-control"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary px-4">
                            Create Blog
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection