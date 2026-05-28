@extends('admin.layouts.layoutAdmin')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">
                User Detail
            </h1>

            <p class="text-gray-500 mt-1">
                View user information
            </p>

        </div>

        <div class="space-x-2">

            <a
                href="{{ route('admin.users.edit', $user->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded"
            >
                Edit User
            </a>

            <a
                href="{{ route('admin.users') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded"
            >
                Back
            </a>

        </div>

    </div>

    <!-- User Card -->
    <div class="bg-white rounded-xl shadow p-8">

        <div class="flex items-center gap-6 mb-10">

            <!-- Avatar -->
            <div class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <!-- User Info -->
            <div>

                <h2 class="text-2xl font-bold">
                    {{ $user->name }}
                </h2>


                <span class=" inline-block px-4 py-2 rounded-full text-sm font-semibold
                    @if($user->role == 'superAdmin')
                        bg-red-100 text-red-700
                    @elseif($user->role == 'admin')
                        bg-blue-100 text-blue-700
                    @else
                        bg-yellow-100 text-yellow-700
                    @endif ">
                    {{ $user->role === 'superAdmin' ? 'Super Admin' : ucfirst($user->role) }}
                </span>
            </div>

        </div>

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

</div>

@endsection