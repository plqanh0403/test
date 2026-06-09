@extends('admin.layout')

@section('content')
<x-admin.page-header
    title="Category Management"
    description="Manage all categories in the system">

    <x-slot:action>
        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createCategoryModal">
            + Create Category
        </button>
    </x-slot:action>

</x-admin.page-header>

<table class="index-table">

    <thead class="table-header">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th width="215">Actions</th>
        </tr>

    </thead>

    <tbody>

        @foreach($categories as $category)

        <tr>

            <td>{{ $category->id }}</td>

            <td>{{ $category->name }}</td>

            <td>{{ $category->slug }}</td>

            <td>
                <button class="btn btn-edit" data-bs-toggle="modal"
                    data-bs-target="#editCategoryModal{{ $category->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this user?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Edit Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Category Name
                                </label>

                                <input type="text" name="name" required value="{{ old('name', $category->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2 mt-6">

                                <a href="{{ route('admin.users') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
                                    Update Category
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
    {{ $categories->links() }}
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>
                    <h3 class="fw-bold mb-1">
                        Create Category
                    </h3>

                    <p class="text-muted mb-0">
                        Create a new blog category.
                    </p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8 d-flex">

                            <div class="admin-card flex-grow-1">

                                <!-- NAME -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Category Name
                                    </label>

                                    <input type="text" name="name" class="form-control admin-input" value="{{ old('name') }}" placeholder="Enter category name..." required>

                                </div>

                                <!-- SEO TITLE -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        SEO Title
                                    </label>

                                    <input type="text" name="seo_title" class="form-control admin-input" value="{{ old('seo_title') }}" placeholder="SEO title...">

                                </div>

                                <!-- SEO DESCRIPTION -->
                                <div>

                                    <label class="form-label fw-semibold">
                                        SEO Description
                                    </label>

                                    <textarea name="seo_description" rows="8" class="form-control admin-input" placeholder="SEO description...">{{ old('seo_description') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <!-- PUBLISH -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Settings
                                </h6>

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

                            <!-- INFO CARD -->
                            <div class="admin-card category_infor">

                                <h6 class="admin-card-title">
                                    Information
                                </h6>

                                <div class="text-muted small">

                                    <p class="mb-3">
                                        Categories help organize blog posts
                                        and improve navigation for users.
                                    </p>

                                    <p class="mb-0">
                                        A slug will be generated automatically
                                        from the category name.
                                    </p>

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

                            Create Category

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection
