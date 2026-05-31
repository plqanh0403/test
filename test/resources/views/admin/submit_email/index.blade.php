@extends('admin/layout/layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Submit Email Management"
    description="Manage all submit emails in the system">

    <x-slot:action>
        <a href="{{ route('admin.submit_emails.export') }}" class="btn btn-create">
            Export CSV
        </a>
    </x-slot:action>

</x-admin.page-header>

<!-- Search & Filter -->
<div class="bg-white rounded-4 shadow-sm p-4 mb-4 border">

    <form action="{{ route('admin.submit_emails') }}" method="GET">

        <div class="row g-3 align-items-end">

            <!-- Search -->
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Search
                </label>

                <div class="input-group search-box">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-muted p-2"></i>
                    </span>

                    <input type="text" name="search" class="form-control" placeholder="Email or Source..."
                        value="{{ request('search') }}">
                </div>
            </div>
 
            <!-- From Date -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    <i class="bi bi-calendar-event me-1 "></i>
                    From Date
                </label>

                <input type="date" name="from_date" class="form-control filter-select p-2 text-secondary" value="{{ request('from_date') }}">
            </div>

            <!-- To Date -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    <i class="bi bi-calendar-check me-1"></i>
                    To Date
                </label>

                <input type="date" name="to_date" class="form-control filter-select p-2 text-secondary" value="{{ request('to_date') }}">
            </div>

            <!-- Buttons -->
            <div class="col-lg-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-funnel-fill me-1"></i>
                        Filter
                    </button>

                    <a href="{{ route('admin.submit_emails') }}" class="btn btn-outline-secondary btn-reset text-dark d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<table class="user-table">

    <thead>

        <tr>
            <th>Email</th>
            <th>Source</th>
            <th>Submitted At</th>
            <th>Status</th>
            <th width="170">Actions</th>
        </tr>

    </thead>

    <tbody>

        @foreach($submitEmails as $submitEmail)

        <tr>
            <td>{{ $submitEmail->email }}</td>
            <td>{{ $submitEmail->source }}</td>
            <td>{{ $submitEmail->created_at }}</td>

            @if ($submitEmail->status === 'processing')
            <td>
                <span
                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Processing</span>
            </td>
            @elseif ($submitEmail->status === 'processed')
            <td>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Processed</span>
            </td>
            @else
            <td>
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
            </td>
            @endif

            <td>
                <form action="{{ route('admin.submit_emails.destroy', $submitEmail->id) }}" method="POST"
                    class="delete-form">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this email?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4 d-flex justify-content-center">
    {{ $submitEmails->links() }}
</div>
@endsection