
@extends('admin.layouts.layoutAdmin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <!-- Left -->
        <div>
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                User Management
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Manage all users in the system
            </p>
        </div>

        <!-- Right -->
        <div class="table-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-create">
                + Create User
            </a>
        </div>
    </div>
    

    <table class="user-table">

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th width="215">Actions</th>
            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->username }}</td>

                    <td>
                        @if($user->role === 'superAdmin')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Super Admin
                            </span>
                        @elseif($user->role === 'admin')    
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ ucfirst($user->role) }}
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ ucfirst($user->role) }}
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($user->is_active)
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">
                                Active
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-view">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        @if($user->role != 'superAdmin') 
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this user?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>

                            @if($user->is_active)
                                <form action="{{ route('admin.users.lock', $user->id) }}" method="POST" class="inline-block">

                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-lock px-3 py-1 rounded" onclick="return confirm('Lock this user?')">
                                        <i class="bi bi-lock-fill"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.unlock', $user->id) }}" method="POST" class="inline-block" >

                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-unlock px-3 py-1 rounded" onclick="return confirm('Unlock this user?')">
                                        <i class="bi bi-unlock-fill"></i>
                                    </button>
                                </form>
                            @endif
                        @endif
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection