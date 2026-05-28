@extends('admin.layouts.layoutAdmin')

@section('content')
    <div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>           
            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                Super Admin
            </span>

            @if($user->role != 'superAdmin')
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                Edit User
            </h1>
            @endif

            <p class="text-gray-500 mt-2 text-lg">
                Update user account information
            </p>

        </div>

        <a
            href="{{ route('admin.users') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-lg font-semibold shadow"
        >
            Back
        </a>

    </div>

    <!-- Error Messages -->
    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow p-8">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6" >
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <!-- Role -->
            <div class="form-group">

                <x-input-label for="role" :value="__('Role')" />

                <select id="role" name="role" class="form-input" required >
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
    
            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">

                <a
                    href="{{ route('admin.users') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow"
                >
                    Update User
                </button>

            </div>

        </form>

    </div>

</div>

@endsection