@extends('admin.layouts.layoutAdmin')
@section('content')
    <h1>User List</h1>

    <a href="{{ route('admin.users.create') }}">
        Create User
    </a>

    <hr>

    @foreach($users as $user)

        <p>{{ $user->name }} - {{ $user->email }}</p>

    @endforeach

@endsection