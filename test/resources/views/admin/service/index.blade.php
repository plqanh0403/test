@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Service Management"
    description="Manage all services in the system">

    <x-slot:action>
        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createServiceModal">
            + Create Service
        </button>
    </x-slot:action>

</x-admin.page-header>

<x-admin.search-box :route="route('admin.services')" placeholder="Name or slug...">

    <x-admin.filter-box box_name="Category" select_name='category_id'>
        <option value="">
            -- Select --
        </option>

        @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </x-admin.filter-box>

    <x-admin.filter-box box_name="Visibility" select_name='is_visible'>
        <option value="">
            -- Select --
        </option>

        <option value="1" {{ request('is_visible') === '1' ? 'selected' : '' }}>
            Visible
        </option>

        <option value="0" {{ request('is_visible') === '0' ? 'selected' : '' }}>
            Hidden
        </option>
    </x-admin.filter-box>

</x-admin.search-box>

<table class="index-table">
    <thead class="table-header">
        <tr>
            <th>Order</th>
            <th>Name</th>
            <th>Category</th>
            <th>Overview</th>
            <th>Status</th>
            <th width="215">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->sort_order }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->serviceCategory?->name ?? '-' }}</td>
            <td>{{ Str::limit($service->overview, 30) }}</td>

            @if ($service->is_visible)
            <td>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Visible</span>
            </td>
            @else
            <td>
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Hidden</span>
            </td>
            @endif

            <td>
                <button class="btn btn-view" data-bs-toggle="modal"
                    data-bs-target="#detailServiceModal{{ $service->id }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </button>

                <button class="btn btn-edit" data-bs-toggle="modal"
                    data-bs-target="#editServiceModal{{ $service->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this service?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>

                @if($service->is_visible)
                <form action="{{ route('admin.services.hide', $service->id) }}" method="POST" class="inline-block">

                    @csrf
                    @method('PUT')

                    <button class="btn btn-lock px-3 py-1 rounded" onclick="return confirm('Hide this service?')">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </form>
                @else
                <form action="{{ route('admin.services.show', $service->id) }}" method="POST" class="inline-block">

                    @csrf
                    @method('PUT')

                    <button class="btn btn-unlock px-3 py-1 rounded" onclick="return confirm('Show this service?')">
                        <i class="bi bi-eye-slash-fill"></i>
                    </button>
                </form>
                @endif
            </td>
        </tr>

        <!-- Detail Service Modal -->
        <div class="modal fade" id="detailServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-scrollable">

                <div class="modal-content admin-modal">

                    <!-- HEADER -->
                    <div class="modal-header service-detail-header border-0">

                        <div class="service-profile">

                            <div class="service-avatar">

                                {{ strtoupper(substr($service->name,0,1)) }}

                            </div>

                            <div>

                                <h2>
                                    {{ $service->name }}
                                </h2>

                                <span class="service-status {{ $service->is_visible ? 'visible' : 'hidden' }}">

                                    {{ $service->is_visible ? 'Visible' : 'Hidden' }}

                                </span>

                            </div>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <div class="service-layout">

                            <!-- LEFT -->
                            <div>

                                <!-- Thumbnail -->
                                @if($service->thumbnail)

                                <div class="service-main-card mb-4">

                                    <h5 class="section-title">
                                        Thumbnail
                                    </h5>

                                    <img src="{{ asset($service->thumbnail) }}" alt="{{ $service->thumbnail_alt }}" class="service-preview-image">

                                </div>

                                @endif

                                <!-- Details -->
                                <div class="service-main-card">

                                    <h5 class="section-title">
                                        Details
                                    </h5>

                                    <div class="service-content-box">

                                        {!! $service->details !!}

                                    </div>

                                </div>

                            </div>

                            <!-- RIGHT -->
                            <div>

                                <!-- Overview -->
                                <div class="service-side-card mb-4">

                                    <h5 class="section-title">
                                        Overview
                                    </h5>

                                    <div class="service-content-box">

                                        {{ $service->overview }}

                                    </div>

                                </div>

                                <!-- Information -->
                                <div class="service-side-card mb-4">

                                    <h5 class="section-title">
                                        Information
                                    </h5>

                                    <div class="info-item">

                                        <i class="bi bi-hash"></i>

                                        <div>

                                            <span>ID</span>

                                            <strong>
                                                #{{ $service->id }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="info-item">

                                        <i class="bi bi-sort-numeric-down"></i>

                                        <div>

                                            <span>Category</span>

                                            <strong>
                                                {{ $service->serviceCategory->name ?? null}}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="info-item">

                                        <i class="bi bi-sort-numeric-down"></i>

                                        <div>

                                            <span>Sort Order</span>

                                            <strong>
                                                {{ $service->sort_order }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="info-item">

                                        <i class="bi bi-link-45deg"></i>

                                        <div>

                                            <span>Slug</span>

                                            <strong>
                                                {{ $service->slug }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="info-item">

                                        <i class="bi bi-eye"></i>

                                        <div>

                                            <span>Status</span>

                                            <strong>

                                                {{ $service->is_visible ? 'Visible' : 'Hidden' }}

                                            </strong>

                                        </div>

                                    </div>

                                </div>

                                <!-- SEO -->
                                <div class="service-side-card">

                                    <h5 class="section-title">
                                        SEO Settings
                                    </h5>

                                    <div class="seo-block">

                                        <label>
                                            SEO Title
                                        </label>

                                        <p>
                                            {{ $service->seo_title ?: '-' }}
                                        </p>

                                    </div>

                                    <div class="seo-block">

                                        <label>
                                            SEO Description
                                        </label>

                                        <p>
                                            {{ $service->seo_description ?: '-' }}
                                        </p>

                                    </div>

                                    <div class="seo-block">

                                        <label>
                                            SEO Keywords
                                        </label>

                                        <p>
                                            {{ $service->seo_keywords ?: '-' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="d-flex justify-content-end mt-4">

                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->id }}">

                                <i class="bi bi-pencil-square me-1"></i>

                                Edit Service

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Edit Service Modal -->
        <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">

                <div class="modal-content admin-modal">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">

                        <div>
                            <h3 class="fw-bold mb-1">
                                Edit Service
                            </h3>

                            <p class="text-muted mb-0">
                                Edit service in your website.
                            </p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <!-- LEFT -->
                                <div class="col-lg-8 d-flex">

                                    <div class="admin-card content-card flex-grow-1">

                                        <!-- NAME -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Service Name
                                            </label>

                                            <input type="text" name="name" class="form-control admin-input" value="{{ old('name', $service->name) }}" placeholder="Enter service name..." required>

                                        </div>

                                        <!-- OVERVIEW -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Overview
                                            </label>

                                            <textarea name="overview" rows="5" class="form-control admin-input" placeholder="Short service introduction...">{{ old('overview', $service->overview) }}</textarea>

                                        </div>

                                        <!-- DETAILS -->
                                        <div class="editor-wrapper">

                                            <label class="form-label fw-semibold">
                                                Service Details
                                            </label>

                                            <textarea name="details" class="form-control ckeditor">{{ old('details', $service->details) }}</textarea>

                                        </div>

                                    </div>

                                </div>

                                <!-- RIGHT -->
                                <div class="col-lg-4">

                                    <!-- SETTINGS -->
                                    <div class="admin-card mb-4">

                                        <h6 class="admin-card-title">
                                            Settings
                                        </h6>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Category
                                            </label>

                                            <select name="category_id" class="form-select">

                                                <option value="{{ $service->category_id }}">{{ $service->serviceCategory->name ?? '-- Select Category --'}}</option>

                                                @foreach($serviceCategories as $category)

                                                <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                                                
                                                    {{ $category->name }}

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Visibility
                                            </label>

                                            <select name="is_visible" class="form-select">

                                                <option value="1" {{ old('is_visible', $service->is_visible) == 1 ? 'selected' : '' }}>
                                                    Visible
                                                </option>

                                                <option value="0" {{ old('is_visible', $service->is_visible) == 0 ? 'selected' : '' }}>
                                                    Hidden
                                                </option>

                                            </select>

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Sort Order
                                            </label>

                                            <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="form-control">

                                        </div>

                                    </div>

                                    <!-- MEDIA -->
                                    <div class="admin-card mb-4">

                                        <h6 class="admin-card-title">
                                            Media
                                        </h6>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                Current Thumbnail
                                            </label>

                                            @if($service->thumbnail)
                                                <div class="mb-2">
                                                    <img src="{{ asset($service->thumbnail) }}" class="img-fluid rounded border" style="max-height:150px">
                                                </div>
                                            @else
                                                <p class="text-muted">No thumbnail uploaded</p>
                                            @endif
                                        </div>

                                        <div>
                                            <label class="form-label">
                                                Replace Thumbnail
                                            </label>

                                            <input type="file"
                                                name="thumbnail"
                                                class="form-control">
                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Thumbnail Alt
                                            </label>

                                            <input type="text" name="thumbnail_alt" value="{{ old('thumbnail_alt', $service->thumbnail_alt) }}" class="form-control" placeholder="Image description...">

                                        </div>

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

                                            <input type="text" name="seo_title" value="{{ old('seo_title', $service->seo_title) }}" class="form-control">

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                SEO Description
                                            </label>

                                            <textarea name="seo_description" rows="4" class="form-control">{{ old('seo_description', $service->seo_description) }}</textarea>

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                SEO Keywords
                                            </label>

                                            <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $service->seo_keywords) }}" class="form-control">

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

                                    Update Service

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
    {{ $services->links() }}
</div>

<!-- CREATE SERVICE MODAL -->
<div class="modal fade" id="createServiceModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>
                    <h3 class="fw-bold mb-1">
                        Create Service
                    </h3>

                    <p class="text-muted mb-0">
                        Create a new service for your website.
                    </p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form
                    action="{{ route('admin.services.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8 d-flex">

                            <div class="admin-card content-card flex-grow-1">

                                <!-- NAME -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Service Name
                                    </label>

                                    <input type="text" name="name" class="form-control admin-input" value="{{ old('name') }}" placeholder="Enter service name..." required>

                                </div>

                                <!-- OVERVIEW -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Overview
                                    </label>

                                    <textarea name="overview" rows="5" class="form-control admin-input" placeholder="Short service introduction...">{{ old('overview') }}</textarea>

                                </div>

                                <!-- DETAILS -->
                                <div class="editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Service Details
                                    </label>

                                    <textarea name="details" class="form-control ckeditor">{{ old('details') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <!-- SETTINGS -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Settings
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Category
                                    </label>

                                    <select name="category_id" class="form-select">

                                        <option value="">-- Select Category --</option>

                                        @foreach($serviceCategories as $category)

                                        <option
                                            value="{{ $category->id }}">

                                            {{ $category->name }}

                                        </option>

                                        @endforeach

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

                                <div>

                                    <label class="form-label">
                                        Sort Order
                                    </label>

                                    <input type="number" name="sort_order" value="0" class="form-control">

                                </div>

                            </div>

                            <!-- MEDIA -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Media
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Thumbnail
                                    </label>

                                    <input type="file" name="thumbnail" class="form-control">

                                </div>

                                <div>

                                    <label class="form-label">
                                        Thumbnail Alt
                                    </label>

                                    <input type="text" name="thumbnail_alt" class="form-control" placeholder="Image description...">

                                </div>

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

                                <div class="mb-3">

                                    <label class="form-label">
                                        SEO Description
                                    </label>

                                    <textarea name="seo_description" rows="4" class="form-control"></textarea>

                                </div>

                                <div>

                                    <label class="form-label">
                                        SEO Keywords
                                    </label>

                                    <input type="text" name="seo_keywords" class="form-control">

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

                            Create Service

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection