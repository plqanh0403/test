@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header
    title="EGEAD Information Management"
    description="Manage all information about EGEAD in the system">

    <x-slot:actions>
        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createUserModal">
            + Create Information
        </button>
    </x-slot:actions>

</x-admin.page-header>