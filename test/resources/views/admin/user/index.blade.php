@extends('admin.layout')

@section('content')
<x-admin.page-header title="User Management" description="Manage all users in the system">

    <x-slot:action>
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createUserModal">
            + Create User
        </button>
    </x-slot:action>

</x-admin.page-header>

<x-admin.search-box :route="route('admin.users')" placeholder="Name or username...">

    <x-admin.filter-box box_name="Role" select_name='role'>
        <option value="">
            -- Select --
        </option>

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
    <thead class="table-header text-base">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th width="215px">Actions</th>
        </tr>
    </thead>

    <tbody class="text-sm">
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

                <div class="user-profile-header">

                    <div class="user-avatar">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                    <div class="user-profile-info">

                        <h2>
                            {{ $user->name }}
                        </h2>

                        <p>
                            {{ $user->username }}
                        </p>

                        <div class="d-flex gap-2 mt-2">

                            <span class="profile-role role-{{ $user->role }}">
                                {{ ucfirst($user->role) }}
                            </span>

                            @if($user->is_active)

                            <span class="profile-status active">
                                Active
                            </span>

                            @else

                            <span class="profile-status inactive">
                                Inactive
                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </x-slot:title>

            <div class="user-detail-layout">

                <!-- LEFT -->
                <div class="user-main-card">

                    <h5 class="detail-section-title">
                        Basic Information
                    </h5>

                    <div class="detail-grid">

                        <div class="detail-box">

                            <span>User ID</span>

                            <h4>
                                #{{ $user->id }}
                            </h4>

                        </div>

                        <div class="detail-box">

                            <span>Username</span>

                            <h4>
                                {{ $user->username }}
                            </h4>

                        </div>

                        <div class="detail-box">

                            <span>Role</span>

                            <h4>
                                {{ ucfirst($user->role) }}
                            </h4>

                        </div>

                        <div class="detail-box">

                            <span>Status</span>

                            <h4>
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </h4>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="user-side-card">

                    <h5 class="detail-section-title">
                        Timeline
                    </h5>

                    <div class="timeline-item">

                        <i class="bi bi-person-plus-fill"></i>

                        <div>

                            <strong>Account Created</strong>

                            <p>
                                {{ $user->created_at->format('d M Y H:i') }}
                            </p>

                        </div>

                    </div>

                    <div class="timeline-item">

                        <i class="bi bi-clock-history"></i>

                        <div>

                            <strong>Last Updated</strong>

                            <p>
                                {{ $user->updated_at->format('d M Y H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <x-slot:footer>

                @if($user->role != 'superAdmin')

                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                    <i class="bi bi-pencil-square me-1"></i>
                    Edit User
                </button>

                @endif

            </x-slot:footer>

        </x-admin.modal>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-scrollable">

                <div class="modal-content admin-modal">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">

                        <div>

                            <h3 class="fw-bold mb-1">
                                Edit User
                            </h3>

                            <p class="text-muted mb-0">
                                Edit administrator or editor account.
                            </p>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <!-- LEFT -->
                                <div class="col-lg-8 d-flex flex-column">

                                    <div class="admin-card">

                                        <div class="d-flex align-items-center gap-3 mb-4">

                                            <div class="admin-icon-box">
                                                <i class="bi bi-person-plus"></i>
                                            </div>

                                            <div>

                                                <h6 class="mb-1 fw-bold">
                                                    User Information
                                                </h6>

                                                <small class="text-muted">
                                                    Basic account details
                                                </small>

                                            </div>

                                        </div>

                                        <!-- NAME -->
                                        <div class="mb-4">

                                            <label class="form-label">
                                                Full Name
                                            </label>

                                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control admin-input" placeholder="Enter full name..." required>

                                        </div>

                                    </div>

                                </div>

                                <!-- RIGHT -->
                                <div class="col-lg-4">

                                    <div class="admin-card">

                                        <div class="d-flex align-items-center gap-3 mb-4">

                                            <div class="admin-icon-box">
                                                <i class="bi bi-shield-lock"></i>
                                            </div>

                                            <div>

                                                <h6 class="mb-1 fw-bold">
                                                    Permissions
                                                </h6>

                                                <small class="text-muted">
                                                    Role & account status
                                                </small>

                                            </div>

                                        </div>

                                        <!-- ROLE -->
                                        <div class="mb-4">

                                            <label class="form-label">
                                                Role
                                            </label>

                                            <select name="role" class="form-select" required>

                                                <option value="">Select Role</option>

                                                <option value="admin"
                                                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>

                                                <option value="editor"
                                                    {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>
                                                    Editor
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="d-flex justify-content-end gap-2 mt-4">

                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit" class="btn btn-primary px-4">

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

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h3 class="fw-bold mb-1">
                        Create User
                    </h3>

                    <p class="text-muted mb-0">
                        Create a new administrator or editor account.
                    </p>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form action="{{ route('admin.users.store') }}" method="POST">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8 d-flex flex-column">

                            <div class="admin-card">

                                <div class="d-flex align-items-center gap-3 mb-4">

                                    <div class="admin-icon-box">
                                        <i class="bi bi-person-plus"></i>
                                    </div>

                                    <div>

                                        <h6 class="mb-1 fw-bold">
                                            User Information
                                        </h6>

                                        <small class="text-muted">
                                            Basic account details
                                        </small>

                                    </div>

                                </div>

                                <!-- NAME -->
                                <div class="mb-4">

                                    <label class="form-label">
                                        Full Name
                                    </label>

                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control admin-input" placeholder="Enter full name..." required>

                                </div>

                                <!-- USERNAME -->
                                <div class="mb-4">

                                    <label class="form-label">
                                        Username
                                    </label>

                                    <input type="text" name="username" value="{{ old('username') }}" class="form-control admin-input" placeholder="Enter username..." required>

                                </div>

                                <div class="row">

                                    <!-- PASSWORD -->
                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Password
                                        </label>

                                        <input type="password" name="password" class="form-control admin-input" required>

                                    </div>

                                    <!-- CONFIRM PASSWORD -->
                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Confirm Password
                                        </label>

                                        <input type="password" name="password_confirmation" class="form-control admin-input" required>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <div class="admin-card">

                                <div class="d-flex align-items-center gap-3 mb-4">

                                    <div class="admin-icon-box">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>

                                    <div>

                                        <h6 class="mb-1 fw-bold">
                                            Permissions
                                        </h6>

                                        <small class="text-muted">
                                            Role & account status
                                        </small>

                                    </div>

                                </div>

                                <!-- ROLE -->
                                <div class="mb-4">

                                    <label class="form-label">
                                        Role
                                    </label>

                                    <select name="role" class="form-select" required>

                                        <option value="">
                                            Select Role
                                        </option>

                                        <option value="admin"
                                            {{ old('role') == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>

                                        <option value="editor"
                                            {{ old('role') == 'editor' ? 'selected' : '' }}>
                                            Editor
                                        </option>

                                    </select>

                                </div>

                                <!-- STATUS -->
                                <div>

                                    <label class="form-label">
                                        Account Status
                                    </label>

                                    <select name="is_active" class="form-select">

                                        <option value="1"
                                            {{ old('is_active',1) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0"
                                            {{ old('is_active') == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit" class="btn btn-primary px-4">

                            Create User

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const nameInput = document.querySelector('#createUserModal [name="name"]');
        const slugInput = document.querySelector('#createUserModal [name="slug"]');

        if (!nameInput || !slugInput) return;

        function slugify(text) {
            return text
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }

        nameInput.addEventListener('input', () => {
            slugInput.value = slugify(nameInput.value);
        });

    });
</script>
@endsection
