@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header title="User Management" description="Manage all users in the system">

    <x-slot:action>
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createUserModal">
            + Create User
        </button>
    </x-slot:action>

</x-admin.page-header>

<x-admin.search-box route="route('admin.users')" placeholder="Name or username...">

        <x-admin.filter-box box_name="Role" select_name='role'>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>
                Admin
            </option>

            <option value="editor" {{ request('role') === 'editor' ? 'selected' : '' }}>
                Editor
            </option>
        </x-admin.filter-box>

        <x-admin.filter-box box_name="Status" select_name='is_actived'>
                <option value="">
                    -- Select --
                </option>

                <option value="1" {{ request('is_actived') === '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0" {{ request('is_actived') === '0' ? 'selected' : '' }}>
                    Inactive
                </option>
        </x-admin.filter-box>

</x-admin.search-box>

<table class="index-table">
    <thead class="table-header">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th width="215px">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>

            <td>
                <x-admin.role-badge :role="$user->role" />
            </td>

            <td>
                <x-admin.active-status-badge :active="$user->is_active" />
            </td>

            <td>
                <div class="action-buttons">
                    <button class="btn btn-view" data-bs-toggle="modal"
                        data-bs-target="#detailUserModal{{ $user->id }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                    @if($user->role != 'superAdmin')
                    <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">

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
                    <form action="{{ route('admin.users.unlock', $user->id) }}" method="POST" class="inline-block">

                        @csrf
                        @method('PUT')

                        <button class="btn btn-unlock px-3 py-1 rounded" onclick="return confirm('Unlock this user?')">
                            <i class="bi bi-unlock-fill"></i>
                        </button>
                    </form>
                    @endif
                    @endif
                </div>
            </td>
        </tr>

        <!-- Detail User Modal -->
        <x-admin.modal id="detailUserModal{{ $user->id }}" size="xl">
            <x-slot:title>
                <!-- Avatar -->
                <div
                    class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <!-- User Info -->
                <div>

                    <h2 class="text-2xl font-bold">
                        {{ $user->name }}
                    </h2>

                    <x-admin.role-badge :role="$user->role" />
                </div>
            </x-slot:title>

            <!-- User Card -->
            <div class="bg-white rounded-xl shadow p-8">

                <!-- Detail Grid -->
                <div class="grid grid-cols-2 gap-6">

                    <div class="bg-gray-100 p-5 rounded-lg">

                        <p class="text-gray-500 text-sm mb-1">
                            User ID
                        </p>

                        <p class="text-xl font-semibold">
                            #{{ $user->id }}
                        </p>

                    </div>

                    <div class="bg-gray-100 p-5 rounded-lg">

                        <p class="text-gray-500 text-sm mb-1">
                            Username
                        </p>

                        <p class="text-xl font-semibold break-all">
                            {{ $user->username }}
                        </p>

                    </div>

                    <div class="bg-gray-100 p-5 rounded-lg">

                        <p class="text-gray-500 text-sm mb-1">
                            Account Created
                        </p>

                        <p class="text-xl font-semibold">
                            {{ $user->created_at->format('d M Y') }}
                        </p>

                    </div>

                    <div class="bg-gray-100 p-5 rounded-lg">

                        <p class="text-gray-500 text-sm mb-1">
                            Last Updated
                        </p>

                        <p class="text-xl font-semibold">
                            {{ $user->updated_at->format('d M Y') }}
                        </p>

                    </div>
                </div>
            </div>

            <x-slot:footer>
                @if($user->role != 'superAdmin')
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded" data-bs-toggle="modal"
                    data-bs-target="#editUserModal{{ $user->id }}">
                    Edit User
                </button>
                @endif
            </x-slot:footer>
        </x-admin.modal>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Edit User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name
                                </label>

                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Role -->
                            <div class="form-group">

                                <x-input-label for="role" :value="__('Role')" />

                                <select id="role" name="role" class="form-input" required>
                                    <option value=""> Select Role </option>

                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>
                                        Editor
                                    </option>

                                </select>

                                <x-input-error :messages="$errors->get('role')" class="form-error" />

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('admin.users') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
                                    Update User
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
    {{ $users->links() }}
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h4 class="modal-title fw-bold text-dark mb-1">Create User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 pb-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">

                        <x-input-label for="name" :value="__('Name')" />

                        <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required
                            autofocus autocomplete="name" />

                        <x-input-error :messages="$errors->get('name')" class="form-error" />

                    </div>

                    <!-- Username -->
                    <div class="form-group">

                        <x-input-label for="username" :value="__('Username')" />

                        <x-text-input id="username" class="form-input" type="text" name="username"
                            :value="old('username')" required autocomplete="username" />

                        <x-input-error :messages="$errors->get('username')" class="form-error" />

                    </div>

                    <!-- Role -->
                    <div class="form-group">

                        <x-input-label for="role" :value="__('Role')" />

                        <select id="role" name="role" class="form-input" required>
                            <option value="">Select Role</option>

                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>

                            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                        </select>

                        <x-input-error :messages="$errors->get('role')" class="form-error" />

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="form-input" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="form-error" />

                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">

                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="form-input" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />

                    </div>

                    <!-- Footer -->

                    <div class="d-flex justify-content-end gap-2">

                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-create">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
