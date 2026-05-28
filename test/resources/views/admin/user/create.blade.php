@extends('admin.layouts.layoutAdmin')

@section('content')

<div class="form-wrapper">

    <div class="form-card">

        <div class="form-header">

            <h1>Create User</h1>

            <a href="{{ route('admin.users') }}" class="btn btn-back">
                ← Back
            </a>

        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">

            @csrf

            <!-- Name -->
            <div class="form-group">

                <x-input-label for="name" :value="__('Name')" />

                <x-text-input
                    id="name"
                    class="form-input"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                />

                <x-input-error :messages="$errors->get('name')" class="form-error" />

            </div>

            <!-- Username -->
            <div class="form-group">

                <x-input-label for="username" :value="__('Username')" />

                <x-text-input id="username" class="form-input" type="text" name="username" :value="old('username')" required autocomplete="username" />

                <x-input-error :messages="$errors->get('username')" class="form-error" />

            </div>

            <!-- Role -->
            <div class="form-group">

                <x-input-label for="role" :value="__('Role')" />

                <select id="role" name="role" class="form-input" required>
                    <option value="">
                        Select Role
                    </option>

                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>
                        Editor
                    </option>

                </select>

                <x-input-error :messages="$errors->get('role')" class="form-error" />

            </div>

            <!-- Password -->
            <div class="form-group">

                <x-input-label for="password" :value="__('Password')" />

                <x-text-input
                    id="password"
                    class="form-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />

                <x-input-error :messages="$errors->get('password')" class="form-error" />

            </div>

            <!-- Confirm Password -->
            <div class="form-group">

                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input
                    id="password_confirmation"
                    class="form-input"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />

            </div>

            <div class="form-actions">

                <button type="submit" class="btn btn-create">
                    Create User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection