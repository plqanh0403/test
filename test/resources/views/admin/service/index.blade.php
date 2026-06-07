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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header flex justify-content-start items-center gap-6 mb-10 pb-0">

                        <!-- Avatar -->
                        <div
                            class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold">
                            {{ strtoupper(substr($service->name, 0, 1)) }}
                        </div>

                        <!-- Service Info -->
                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $service->name }}
                            </h2>

                            <p class="text-2xl font-bold text-secondary">
                                #{{ $service->sort_order }}
                            </p>

                            <span class=" inline-block px-4 py-2 rounded-full text-sm font-semibold
                                        @if($service->is_visible == 1)
                                            bg-green-100 text-green-700
                                        @else
                                            bg-red-100 text-red-700
                                        @endif ">
                                {{ ucfirst($service->is_visible) ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">

                        <!-- Service Card -->
                        <div class="bg-white rounded-xl shadow p-8">

                            <!-- Detail Grid -->
                            <div class="grid grid-cols-2 gap-6">

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Service ID
                                    </p>

                                    <p class="text-xl font-semibold">
                                        #{{ $service->id }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Overview
                                    </p>

                                    <p class="text-xl font-semibold break-all">
                                        {{ $service->overview }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Details
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->details }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Thumbnail
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->thumbnail }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Thumbnail Alt Text
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->thumbnail_alt }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Banner Image
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->banner_image }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Slug
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->slug }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        SEO Title
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->seo_title }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        SEO Description
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->seo_description }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        SEO Keywords
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $service->seo_keywords }}
                                    </p>

                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-1 mt-6">

                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded"
                                    data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->id }}">
                                    Edit Service
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Service Modal -->
        <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Edit Service</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Name
                                </label>

                                <input type="text" name="name" value="{{ old('name', $service->name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Overview -->
                            <div class="form-group">

                                <x-input-label for="overview" :value="__('Overview')" />

                                <textarea id="overview" name="overview" class="form-input" rows="4"
                                    required>{{ old('overview', $service->overview) }}</textarea>

                            </div>

                            <!-- Details -->
                            <div class="form-group">

                                <x-input-label for="details" :value="__('Details')" />

                                <textarea id="details" name="details" class="form-input" rows="4"
                                    required>{{ old('details', $service->details) }}</textarea>
                            </div>

                            <!-- Thumbnail -->
                            <div class="form-group">

                                <x-input-label for="thumbnail" :value="__('Thumbnail')" />

                                <input type="file" id="thumbnail" name="thumbnail" class="form-input">
                            </div>

                            <!-- Thumbnail Alt Text -->
                            <div class="form-group">

                                <x-input-label for="thumbnail_alt" :value="__('Thumbnail Alt Text')" />

                                <input type="text" id="thumbnail_alt" name="thumbnail_alt"
                                    value="{{ old('thumbnail_alt', $service->thumbnail_alt) }}" class="form-input">
                            </div>

                            <!-- Banner Image -->
                            <div class="form-group">

                                <x-input-label for="banner" :value="__('Banner Image')" />

                                <input type="file" id="banner" name="banner" class="form-input">
                            </div>

                            <!-- Slug -->
                            <div class="form-group">

                                <x-input-label for="slug" :value="__('Slug')" />

                                <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}"
                                    class="form-input">
                            </div>

                            <!-- Visibility -->
                            <div class="form-group">

                                <x-input-label for="is_visible" :value="__('Visibility')" />

                                <div class="mt-2 flex items-center gap-3">

                                    <input type="checkbox" id="is_visible" name="is_visible" value="1"
                                        {{ old('is_visible', $service->is_visible) ? 'checked' : '' }} class="w-5 h-5">

                                    <label for="is_visible" class="text-sm text-gray-700">
                                        Visible on website
                                    </label>

                                </div>

                                <x-input-error :messages="$errors->get('is_visible')" class="form-error" />

                            </div>

                            <!-- SEO Title -->
                            <div class="form-group">

                                <x-input-label for="seo_title" :value="__('SEO Title')" />

                                <input type="text" id="seo_title" name="seo_title"
                                    value="{{ old('seo_title', $service->seo_title) }}" class="form-input">

                            </div>

                            <!-- SEO Description -->
                            <div class="form-group">

                                <x-input-label for="seo_description" :value="__('SEO Description')" />

                                <textarea id="seo_description" name="seo_description" class="form-input"
                                    rows="4">{{ old('seo_description', $service->seo_description) }}</textarea>

                            </div>

                            <!-- SEO Keywords -->
                            <div class="form-group">

                                <x-input-label for="seo_keywords" :value="__('SEO Keywords')" />

                                <input type="text" id="seo_keywords" name="seo_keywords"
                                    value="{{ old('seo_keywords', $service->seo_keywords) }}" class="form-input">
                            </div>

                            <!-- Sort Order -->
                            <div class="form-group">

                                <x-input-label for="sort_order" :value="__('Sort Order')" />

                                <input type="number" id="sort_order" name="sort_order"
                                    value="{{ old('sort_order', $service->sort_order) }}" class="form-input">
                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('admin.services') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
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

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
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

                                    <select
                                        name="category_id"
                                        class="form-select">

                                        <option value="">
                                            -- Select Category --
                                        </option>

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

                                    <select
                                        name="is_visible"
                                        class="form-select">

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

                                    <input
                                        type="number"
                                        name="sort_order"
                                        value="0"
                                        class="form-control">

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

                                    <input
                                        type="file"
                                        name="thumbnail"
                                        class="form-control">

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

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary px-4">

                            Create Service

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection