@extends('admin.layout.layoutAdmin1')

@section('content')
<div class="flex justify-between items-center mb-8">
    <!-- Left -->
    <div>
        <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
            Service Management
        </h1>

        <p class="text-gray-500 mt-2 text-lg">
            Manage all services in the system
        </p>
    </div>

    <!-- Right -->
    <div class="table-header">
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createServiceModal">
            + Create Service
        </button>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-4 shadow-sm p-4 mb-4 border">

    <form action="{{ route('admin.services') }}" method="GET">

        <div class="row g-3 align-items-end">

            <!-- Search -->
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Search
                </label>

                <div class="input-group search-box">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-muted p-2"></i>
                    </span>

                    <input type="text" name="search" class="form-control" placeholder="Name or slug..."
                        value="{{ request('search') }}">
                </div>
            </div>

            <!-- Category -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Category
                </label>

                <select name="category_id" class="form-control filter-select p-2 text-secondary">
                    <option value="">All Type</option>

                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Visibility -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Visibility
                </label>

                <select name="is_visible" class="form-control filter-select p-2 text-secondary">

                    <option value="">
                        All Visibility
                    </option>

                    <option value="1" {{ request('is_visible') === '1' ? 'selected' : '' }}>
                        Visible
                    </option>

                    <option value="0" {{ request('is_visible') === '0' ? 'selected' : '' }}>
                        Hidden
                    </option>

                </select>
            </div>

            <!-- Buttons -->
            <div class="col-lg-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-funnel-fill me-1"></i>
                        Filter
                    </button>

                    <a href="{{ route('admin.services') }}"
                        class="btn btn-outline-secondary btn-reset text-dark d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<table class="user-table">
    <thead>
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
                    <i class="bi bi-eye-fill"></i>
                </button>

                <button class="btn btn-edit" data-bs-toggle="modal"
                    data-bs-target="#editServiceModal{{ $service->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this service?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
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

<!-- Create Service Modal -->
<div class="modal fade" id="createServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h4 class="modal-title fw-bold text-dark mb-1">Create Service</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 pb-4">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">

                        <x-input-label for="name" :value="__('Name')" />

                        <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name') ?? ''"
                            required autofocus autocomplete="name" />

                        <x-input-error :messages="$errors->get('name')" class="form-error" />

                    </div>

                    <!-- Overview -->
                    <div class="form-group">

                        <x-input-label for="overview" :value="__('Overview')" />

                        <textarea id="overview" name="overview" class="form-input" rows="4"
                            required>{{ old('overview') }}</textarea>

                        <x-input-error :messages="$errors->get('overview')" class="form-error" />

                    </div>

                    <!-- Details -->
                    <div class="form-group">

                        <x-input-label for="details" :value="__('Details')" />

                        <textarea id="details" name="details" class="form-input" rows="4"
                            required>{{ old('details') }}</textarea>

                        <x-input-error :messages="$errors->get('details')" class="form-error" />

                    </div>

                    <!-- Visibility -->
                    <div class="form-group">

                        <x-input-label for="is_visible" :value="__('Visibility')" />

                        <div class="mt-2 flex items-center gap-3">

                            <input type="checkbox" id="is_visible" name="is_visible" value="1"
                                {{ old('is_visible') ? 'checked' : '' }} class="w-5 h-5">

                            <label for="is_visible" class="text-sm text-gray-700">
                                Visible on website
                            </label>

                        </div>

                        <x-input-error :messages="$errors->get('is_visible')" class="form-error" />

                    </div>

                    <!-- Thumbnail -->
                    <div class="form-group">

                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />

                        <input type="file" id="thumbnail" name="thumbnail" class="form-input">
                    </div>

                    <!-- Thumbnail Alt -->
                    <div class="form-group">

                        <x-input-label for="thumbnail_alt" :value="__('Thumbnail Alt')" />

                        <input type="text" id="thumbnail_alt" name="thumbnail_alt" value="{{ old('thumbnail_alt') }}"
                            class="form-input">

                        <x-input-error :messages="$errors->get('thumbnail_alt')" class="form-error" />
                    </div>

                    <!-- Banner Image -->
                    <div class="form-group">

                        <x-input-label for="banner" :value="__('Banner Image')" />

                        <input type="file" id="banner" name="banner" class="form-input">
                    </div>

                    <!-- Slug -->
                    <div class="form-group">

                        <x-input-label for="slug" :value="__('Slug')" />

                        <x-text-input id="slug" class="form-input" type="text" name="slug" :value="old('slug') ?? ''"
                            required />

                        <x-input-error :messages="$errors->get('slug')" class="form-error" />

                    </div>

                    <!-- SEO Title -->
                    <div class="form-group">

                        <x-input-label for="seo_title" :value="__('SEO Title')" />

                        <x-text-input id="seo_title" class="form-input" type="text" name="seo_title"
                            value="{{ old('seo_title') ?? '' }}" />

                        <x-input-error :messages="$errors->get('seo_title')" class="form-error" />

                    </div>

                    <!-- SEO Description -->
                    <div class="form-group">

                        <x-input-label for="seo_description" :value="__('SEO Description')" />

                        <textarea id="seo_description" name="seo_description" class="form-input"
                            rows="4">{{ old('seo_description') }}</textarea>

                        <x-input-error :messages="$errors->get('seo_description')" class="form-error" />
                    </div>

                    <!-- SEO Keywords -->
                    <div class="form-group">

                        <x-input-label for="seo_keywords" :value="__('SEO Keywords')" />

                        <x-text-input id="seo_keywords" class="form-input" type="text" name="seo_keywords"
                            value="{{ old('seo_keywords') ?? '' }}" />

                        <x-input-error :messages="$errors->get('seo_keywords')" class="form-error" />

                    </div>

                    <!-- Footer -->

                    <div class="d-flex justify-content-end gap-2">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success">
                            Create Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection