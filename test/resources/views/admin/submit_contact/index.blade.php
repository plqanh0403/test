@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layout')

@section('content')
    <x-admin.page-header title="Submit Contact Management" description="Manage all submit contacts in the system">

        <x-slot:action>
            <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createContactModal">
                + Add Submitted Contact
            </button>

            <a href="{{ route('admin.submit_contacts.export') }}" class="btn btn-export">
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


    <x-admin.search-box :route="route('admin.submit_contacts')" placeholder="Search by name, email, phone, company...">
        <x-admin.filter-box box_name="Status" select_name='status'>
            <option value="">
                -- Select --
            </option>

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
        </x-admin.filter-box>
    </x-admin.search-box>

    <table class="index-table">

        <thead class="table-header">

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Status</th>
                <th>Note</th>
                <th width="170">Actions</th>
            </tr>

        </thead>

        <tbody class="text-sm">

            @foreach ($submitContacts as $submitContact)
                <tr>

                    <td>{{ $submitContact->name }}</td>

                    <td>{{ $submitContact->email }}</td>

                    <td>{{ $submitContact->company }}</td>

                    <td class="text-center align-middle">
                        @if ($submitContact->status === 'processing')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold"
                                id="table-status-badge-{{ $submitContact->id }}">Processing</span>
                        @elseif ($submitContact->status === 'processed')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold"
                                id="table-status-badge-{{ $submitContact->id }}">Processed</span>
                        @elseif ($submitContact->status === 'new')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold"
                                id="table-status-badge-{{ $submitContact->id }}">New</span>
                        @else
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold"
                                id="table-status-badge-{{ $submitContact->id }}">Seen</span>
                        @endif
                    </td>

                    <td>{{ Str::limit($submitContact->internal_note, 20) }}</td>

                    <td>
                        <button data-id="{{ $submitContact->id }}" data-status="{{ $submitContact->status }}"
                            class="btn btn-view mark-seen-btn" data-bs-toggle="modal"
                            data-bs-target="#detailSubmitContactModal{{ $submitContact->id }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </button>

                        <button class="btn btn-edit" data-bs-toggle="modal"
                            data-bs-target="#updateContactModal{{ $submitContact->id }}">
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
                <div class="modal fade" id="detailSubmitContactModal{{ $submitContact->id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 rounded-4 shadow-lg">
                            <div class="modal-header contact-detail-header border-0">

                                <div class="contact-profile">

                                    <div class="contact-avatar">
                                        {{ strtoupper(substr($submitContact->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <h2>
                                            {{ $submitContact->name }}
                                        </h2>

                                        <p>
                                            {{ $submitContact->email }}
                                        </p>

                                        @if ($submitContact->status === 'processing')
                                            <span
                                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold"
                                                id="modal-status-badge-{{ $submitContact->id }}">Processing</span>
                                        @elseif ($submitContact->status === 'processed')
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold"
                                                id="modal-status-badge-{{ $submitContact->id }}">Processed</span>
                                        @elseif ($submitContact->status === 'new')
                                            <span
                                                class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold"
                                                id="modal-status-badge-{{ $submitContact->id }}">New</span>
                                        @else
                                            <span
                                                class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold"
                                                id="modal-status-badge-{{ $submitContact->id }}">Seen</span>
                                        @endif

                                    </div>

                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">

                                <div class="contact-layout">

                                    <!-- LEFT -->
                                    <div class="contact-main-card">

                                        <h5 class="section-title">
                                            Message
                                        </h5>

                                        <div class="message-box">

                                            {!! nl2br(e($submitContact->message)) !!}

                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="contact-side-column">
                                        <div class="contact-side-card">

                                            <h5 class="section-title">
                                                Contact Details
                                            </h5>

                                            <div class="info-item">

                                                <i class="bi bi-envelope-fill"></i>

                                                <div>

                                                    <span>Email</span>

                                                    <strong>
                                                        {{ $submitContact->email }}
                                                    </strong>

                                                </div>

                                            </div>

                                            <div class="info-item">

                                                <i class="bi bi-telephone-fill"></i>

                                                <div>

                                                    <span>Phone</span>

                                                    <strong>
                                                        {{ $submitContact->phone ?? '-' }}
                                                    </strong>

                                                </div>

                                            </div>

                                            <div class="info-item">

                                                <i class="bi bi-building"></i>

                                                <div>

                                                    <span>Company</span>

                                                    <strong>
                                                        {{ $submitContact->company ?? '-' }}
                                                    </strong>

                                                </div>

                                            </div>

                                            <div class="info-item">

                                                <i class="bi bi-calendar-event"></i>

                                                <div>

                                                    <span>Submitted</span>

                                                    <strong>
                                                        {{ $submitContact->created_at->format('d M Y H:i') }}
                                                    </strong>

                                                </div>

                                            </div>

                                        </div>


                                        @if ($submitContact->internal_note)
                                            <div class="contact-note-card">

                                                <h5 class="section-title">
                                                    Internal Note
                                                </h5>

                                                <p>
                                                    {{ $submitContact->internal_note }}
                                                </p>

                                            </div>
                                        @endif

                                    </div>

                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-2 mt-4">

                                    @if ($submitContact->status == 'seen')
                                        <form
                                            action="{{ route('admin.submit_contacts.update_processing', $submitContact) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-warning">

                                                <i class="bi bi-hourglass-split me-1"></i>

                                                Start Processing

                                            </button>

                                        </form>
                                    @elseif($submitContact->status == 'processing')
                                        <form
                                            action="{{ route('admin.submit_contacts.update_processed', $submitContact) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-success">

                                                <i class="bi bi-check-circle-fill me-1"></i>

                                                Mark As Processed

                                            </button>

                                        </form>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Note Modal -->
                <div class="modal fade" id="updateContactModal{{ $submitContact->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content admin-modal">

                            <!-- Modal Header -->
                            <div class="modal-header border-0 pb-0">

                                <div>
                                    <h3 class="fw-bold mb-1">
                                        Edit Contact
                                    </h3>

                                    <p class="text-muted mb-0">
                                        Update submitted contact in your website.
                                    </p>
                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">

                                <form action="{{ route('admin.submit_contacts.update_note', $submitContact->id) }}"
                                    method="POST" enctype="multipart/form-data">
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
                                                            Contact Information
                                                        </h6>

                                                        <small class="text-muted">
                                                            Contact details
                                                        </small>

                                                    </div>

                                                </div>

                                                <!-- NAME -->
                                                <div class="mb-4">

                                                    <label class="form-label">
                                                        Full Name
                                                    </label>

                                                    <input type="text" name="name"
                                                        value="{{ old('name', $submitContact->name) }}"
                                                        class="form-control admin-input" placeholder="Enter full name..."
                                                        required>

                                                </div>

                                                <div class="mb-4">

                                                    <label class="form-label">
                                                        Email
                                                    </label>

                                                    <input type="email" name="email"
                                                        value="{{ old('email', $submitContact->email) }}"
                                                        class="form-control admin-input" placeholder="Enter email..."
                                                        required>

                                                </div>

                                                <div class="mb-4">

                                                    <label class="form-label">
                                                        Phone
                                                    </label>

                                                    <input type="tel" name="phone"
                                                        value="{{ old('phone', $submitContact->phone) }}"
                                                        class="form-control admin-input"
                                                        placeholder="Enter phone number..." required>

                                                </div>

                                                <div class="mb-4">

                                                    <label class="form-label">
                                                        Company
                                                    </label>

                                                    <input type="text" name="company"
                                                        value="{{ old('company', $submitContact->company) }}"
                                                        class="form-control admin-input"
                                                        placeholder="Enter company name..." required>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- RIGHT -->
                                        <div class="col-lg-4">

                                            <!-- STATUS -->
                                            <div class="admin-card mb-4">

                                                <h6 class="admin-card-title">
                                                    Processing Status
                                                </h6>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Status
                                                    </label>

                                                    <select name="status" class="form-select">

                                                        <option value="new">
                                                            New
                                                        </option>

                                                        <option value="seen">
                                                            Seen
                                                        </option>

                                                        <option value="processing">
                                                            Processing
                                                        </option>

                                                        <option value="processed">
                                                            Processed
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>

                                            <!-- INTERNAL NOTE -->
                                            <div class="admin-card">

                                                <h6 class="admin-card-title">
                                                    Internal Note
                                                </h6>

                                                <textarea name="internal_note" rows="10" class="form-control ckeditor"
                                                    placeholder="Internal notes for team members...">{{ old('internal_note', $submitContact->internal_note) }}</textarea>

                                            </div>

                                        </div>

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

    <div class="modal fade" id="createContactModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content admin-modal">

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">

                    <div>

                        <h3 class="fw-bold mb-1">
                            Create Contact Submission
                        </h3>

                        <p class="text-muted mb-0">
                            Create a new customer inquiry manually.
                        </p>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <!-- BODY -->
                <div class="modal-body">

                    <form action="{{ route('admin.submit_contacts.store') }}" method="POST">

                        @csrf

                        <div class="row g-4">

                            <!-- LEFT -->
                            <div class="col-lg-8 d-flex flex-column">

                                <!-- CUSTOMER INFO -->
                                <div class="admin-card mb-4">

                                    <h6 class="admin-card-title">
                                        Customer Information
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <label class="form-label">
                                                Full Name
                                            </label>

                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control admin-input" required>

                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-label">
                                                Email
                                            </label>

                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control admin-input" required>

                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-label">
                                                Phone
                                            </label>

                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                class="form-control admin-input">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="form-label">
                                                Company
                                            </label>

                                            <input type="text" name="company" value="{{ old('company') }}"
                                                class="form-control admin-input">

                                        </div>

                                    </div>

                                </div>

                                <!-- MESSAGE -->
                                <div class="admin-card content-card editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Message
                                    </label>

                                    <textarea name="message" rows="12" class="form-control ckeditor admin-input">{{ old('message') }}</textarea>

                                </div>

                            </div>

                            <!-- RIGHT -->
                            <div class="col-lg-4">

                                <!-- STATUS -->
                                <div class="admin-card mb-4">

                                    <h6 class="admin-card-title">
                                        Processing Status
                                    </h6>

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Status
                                        </label>

                                        <select name="status" class="form-select">

                                            <option value="new"
                                                {{ old('status') == 'new' ? 'selected' : '' }}>
                                                New
                                            </option>

                                            <option value="seen"
                                                {{ old('status') == 'seen' ? 'selected' : '' }}>
                                                Seen
                                            </option>

                                            <option value="processing"
                                                {{ old('status') == 'processing' ? 'selected' : '' }}>
                                                Processing
                                            </option>

                                            <option value="processed"
                                                {{ old('status') == 'processed' ? 'selected' : '' }}>
                                                Processed
                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <!-- INTERNAL NOTE -->
                                <div class="admin-card">

                                    <h6 class="admin-card-title">
                                        Internal Note
                                    </h6>

                                    <textarea name="internal_note" rows="10" class="form-control ckeditor"
                                        placeholder="Internal notes for team members...">{{ old('internal_note') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <button type="submit" class="btn btn-primary px-4">

                                Create Contact

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
