@php
use Illuminate\Support\Str;
@endphp

@extends('admin/layout/layoutAdmin1')

@section('content')
<x-admin.page-header title="Submit Contact Management" description="Manage all submit contacts in the system">

    <x-slot:action>
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createServiceModal">
            + Add Submitted Contact
        </button>

        <a href="{{ route('admin.submit_contacts.export') }}" class="btn blue">
            Export CSV
        </a>
    </x-slot:action>

</x-admin.page-header>

{{-- <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">New</h6>
                    <h3>{{ $newCount }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Seen</h6>
            <h3>{{ $seenCount }}</h3>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Processing</h6>
            <h3>{{ $processingCount }}</h3>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Processed</h6>
            <h3>{{ $processedCount }}</h3>
        </div>
    </div>
</div>
</div> --}}

<!-- Search & Filter -->
<div class="bg-white shadow-sm rounded-4 p-4 mb-4 border">

    <form action="{{ route('admin.submit_contacts') }}" method="GET">

        <div class="row g-3 align-items-end">

            <!-- Search -->
            <div class="col-lg-8">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Search Contact
                </label>

                <div class="input-group search-box">
                    <i class="bi bi-search text-muted p-2"></i>

                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name, email, phone, company..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Status -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Status
                </label>

                <select name="status" class="form-control filter-select p-2 text-secondary">
                    <option value="">All Status</option>

                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>
                        New
                    </option>

                    <option value="seen" {{ request('status') == 'seen' ? 'selected' : '' }}>
                        Seen
                    </option>

                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>
                        Processing
                    </option>

                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>
                        Processed
                    </option>
                </select>
            </div>

            <!-- Actions -->
            <div class="col-lg-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-funnel-fill me-1"></i>
                        Filter
                    </button>

                    <a href="{{ route('admin.submit_contacts') }}"
                        class="btn btn-outline-secondary btn-reset text-dark d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<table class="index-table">

    <thead class="table-header">

        <tr>
            <th>Order</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Note</th>
            <th width="170">Actions</th>
        </tr>

    </thead>

    <tbody>

        @foreach($submitContacts as $submitContact)

        <tr>

            <td>{{ $submitContact->sort_order }}</td>

            <td>{{ $submitContact->name }}</td>

            <td>{{ $submitContact->email }}</td>

            <td>{{ $submitContact->company }}</td>

            <td>{{ $submitContact->phone }}</td>

            <td class="text-center align-middle">
                @if ($submitContact->status === 'processing')
                <span
                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Processing</span>
                @elseif ($submitContact->status === 'processed')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Processed</span>
                @elseif ($submitContact->status === 'new')
                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">New</span>
                @else
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">Seen</span>
                @endif
            </td>

            <td>{{ Str::limit($submitContact->internal_note, 20) }}</td>

            <td>
                <button data-id="{{ $submitContact->id }}" class="btn btn-view mark-seen-btn" data-bs-toggle="modal"
                    data-bs-target="#detailSubmitContactModal{{ $submitContact->id }}">
                    <i class="bi bi-eye-fill"></i>
                </button>

                <button class="btn btn-edit" data-bs-toggle="modal"
                    data-bs-target="#updateNoteModal{{ $submitContact->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.submit_contacts.destroy', $submitContact->id) }}" method="POST"
                    class="inline-block">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this contact?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>

        <!-- Detail Submit Contact Modal -->
        <div class="modal fade" id="detailSubmitContactModal{{ $submitContact->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header flex justify-content-start items-center gap-6 mb-10 pb-0">

                        <!-- Contact Info -->
                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $submitContact->name }}
                            </h2>

                            <p class="text-gray-500 mt-2 text-lg">
                                {{ $submitContact->email }}
                            </p>

                            <span class=" inline-block px-4 py-2 rounded-full text-sm font-semibold
                                        @if($submitContact->status == 'seen')
                                            bg-blue-100 text-blue-700
                                        @elseif($submitContact->status == 'processing')
                                            bg-yellow-100 text-yellow-700
                                        @elseif($submitContact->status == 'processed')
                                            bg-green-100 text-green-700
                                        @else
                                            bg-red-100 text-red-700
                                        @endif ">
                                {{ ucfirst($submitContact->status) }}
                            </span>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">

                        <!-- User Card -->
                        <div class="bg-white rounded-xl shadow p-8">

                            <!-- Detail Grid -->
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-gray-100 p-5 rounded-lg">
                                    <p class="text-gray-500 text-sm mb-1">
                                        Phone
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $submitContact->phone ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">
                                    <p class="text-gray-500 text-sm mb-1">
                                        Company
                                    </p>

                                    <p class="text-xl font-semibold break-all">
                                        {{ $submitContact->company ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">
                                    <p class="text-gray-500 text-sm mb-1">
                                        Message
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $submitContact->message ?? '-' }}
                                    </p>
                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">
                                    <p class="text-gray-500 text-sm mb-1">
                                        Created At
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $submitContact->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg col-span-2">
                                    <p class="text-gray-500 text-sm mb-1">
                                        Internal Note
                                    </p>

                                    <p class="text-xl font-semibold break-all">
                                        {{ $submitContact->internal_note ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-1 mt-6">
                            @if($submitContact->status == 'seen')
                            <form action="{{ route('admin.submit_contacts.update_processing', $submitContact) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">
                                    Start Processing
                                </button>
                            </form>
                            @elseif($submitContact->status == 'processing')
                            <form action="{{ route('admin.submit_contacts.update_processed', $submitContact) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded">
                                    Mark as Processed
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Note Modal -->
        <div class="modal fade" id="updateNoteModal{{ $submitContact->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Update Internal Note</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.submit_contacts.update_note', $submitContact->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Internal Note -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Internal Note
                                </label>

                                <input type="text" name="internal_note"
                                    value="{{ old('internal_note', $submitContact->internal_note) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2 mt-6">
                                <a href="{{ route('admin.submit_contacts') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
                                    Update Note
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
    {{ $submitContacts->links() }}
</div>
@endsection