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


<table class="index-table">
    <thead class="table-header">
        <tr>
            <th width="50">Order</th>
            <th>Title</th>
            <th>Excerpt</th>
            <th>Type</th>
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
            <td>{{ $blog->type }}</td>
            <td>
                @if($blog->status === 'draft')
                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                    Draft
                </span>
                @else
                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">
                    Published
                </span>
                @endif
            </td>

            <td>
                <button class="btn btn-view" data-bs-toggle="modal" data-bs-target="#detailBlogModal{{ $blog->id }}">
                    <i class="bi bi-eye-fill"></i>
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
            </td>
        </tr>

        <!-- Detail Blog Modal -->
        <div class="modal fade" id="detailBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header flex justify-content-start items-center gap-6 mb-10 pb-0">
                        <!-- Blog Info -->
                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $blog->title }}
                            </h2>

                            <span class=" inline-block px-4 py-2 rounded-full text-sm font-semibold
                                        @if($blog->status == 'draft')
                                            bg-green-100 text-green-700
                                        @else
                                            bg-red-100 text-red-700
                                            bg-blue-100 text-blue-700                                   
                                        @endif ">
                            </span>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">

                        <!-- Blog Card -->
                        <div class="bg-white rounded-xl shadow p-8">

                            <!-- Detail Grid -->
                            <div class="grid grid-cols-2 gap-6">

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Excerpt
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $blog->excerpt }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Slug
                                    </p>

                                    <p class="text-xl font-semibold break-all">
                                        {{ $blog->slug }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Published Date
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $blog->created_at->format('d M Y') }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Last Updated
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $blog->updated_at->format('d M Y') }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Content
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $blog->content }}
                                    </p>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-1 mt-6">
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded"
                                data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}">
                                Edit Blog
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Blog Modal -->
        <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Edit Blog</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name
                                </label>

                                <input type="text" name="name" value="{{ old('name', $blog->name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Category -->
                            <div class="form-group">

                                <x-input-label for="category" :value="__('Category')" />

                                <select id="category" name="category" class="form-input" required>
                                    <option value=""> Select Category </option>

                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach

                                </select>

                                <x-input-error :messages="$errors->get('category')" class="form-error" />

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('admin.blogs') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
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

<!-- Create Blog Modal -->
<div class="modal fade" id="createBlogModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h4 class="modal-title fw-bold text-dark mb-1">Create Blog</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 pb-4">
                <form action="{{ route('admin.blogs.store') }}" method="POST">
                    @csrf

                    <!-- Title -->
                    <div class="form-group">

                        <x-input-label for="title" :value="__('Title')" />

                        <x-text-input id="title" class="form-input" type="text" name="title" :value="old('title')"
                            required autofocus autocomplete="title" />

                        <x-input-error :messages="$errors->get('title')" class="form-error" />

                    </div>

                    <!-- Category -->
                    <div class="form-group">

                        <x-input-label for="category" :value="__('Category')" />

                        <select id="category" name="category" class="form-input" required>
                            <option value="">-- Select Category --</option>

                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('category')" class="form-error" />

                    </div>

                    <!-- Type -->
                    <div class="form-group">

                        <x-input-label for="type" :value="__('Type')" />

                        <select id="type" name="type" class="form-input" required>
                            <option value="" readonly>-- Select Type--</option>

                            <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Service</option>

                            <option value="company_activity" {{ old('type') == 'company_activity' ? 'selected' : '' }}>
                                Company Activity</option>
                        </select>

                        <x-input-error :messages="$errors->get('type')" class="form-error" />

                    </div>

                    <!-- Excerpt -->
                    <div class="form-group">

                        <x-input-label for="excerpt" :value="__('Excerpt')" />

                        <textarea id="excerpt" name="excerpt" class="form-input" rows="3"
                            required>{{ old('excerpt') }}</textarea>

                        <x-input-error :messages="$errors->get('excerpt')" class="form-error" />

                    </div>

                    <!-- Content -->
                    <div class="form-group">

                        <x-input-label for="content" :value="__('Content')" />

                        <textarea id="content" name="content" class="form-input" rows="5"
                            required>{{ old('content') }}</textarea>

                        <x-input-error :messages="$errors->get('content')" class="form-error" />
                    </div>

                    <!-- SEO Title -->
                    <div class="form-group">
                        <div class="form-group">

                            <x-input-label for="seo_title" :value="__('SEO Title')" />

                            <x-text-input id="seo_title" class="form-input" type="text" name="seo_title"
                                :value="old('seo_title')" required autofocus autocomplete="seo_title" />

                            <x-input-error :messages="$errors->get('seo_title')" class="form-error" />
                        </div>

                        <!-- SEO Description -->
                        <div class="form-group">
                            <div class="form-group">

                                <x-input-label for="seo_description" :value="__('SEO Description')" />

                                <x-text-input id="seo_description" class="form-input" type="text" name="seo_description"
                                    :value="old('seo_description')" required autofocus autocomplete="seo_description" />

                                <x-input-error :messages="$errors->get('seo_description')" class="form-error" />
                            </div>


                            <!-- Thumbnail -->
                            <div class="form-group">

                                <x-input-label for="thumbnail" :value="__('Thumbnail')" />

                                <input id="thumbnail" type="file" name="thumbnail" class="form-input">

                                <x-input-error :messages="$errors->get('thumbnail')" class="form-error" />

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2 mt-6">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit" class="btn btn-success">
                                    Create Blog
                                </button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection