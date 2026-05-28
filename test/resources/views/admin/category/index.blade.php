@extends('admin/layouts/layoutAdmin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <!-- Left -->
        <div>
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                Category Management
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Manage all categories in the system
            </p>
        </div>

        <!-- Right -->
        <div class="table-header">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-create">
                + Create Category
            </a>
        </div>
    </div>
    

    <table class="user-table">

        <thead>

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
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this user?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>                      
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection