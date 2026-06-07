@extends('admin/layout/layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Submit Email Management"
    description="Manage all submit emails in the system">

    <x-slot:action>
        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createSubmitEmailModal">
            + Add Submitted Email
        </button>

        <a href="{{ route('admin.submit_emails.export') }}" class="btn blue">
            Export CSV
        </a>
    </x-slot:action>

</x-admin.page-header>

<x-admin.search-box :route="route('admin.submit_emails')" placeholder="Email or source...">

    <x-admin.date-filter-box date_name="From date" input_name="from_date" request_name="from_date"></x-admin.filter-box>
    <x-admin.date-filter-box date_name="To date" input_name="to_date" request_name="to_date"></x-admin.filter-box>

</x-admin.search-box>

<table class="index-table">

    <thead class="table-header">

        <tr>
            <th>Email</th>
            <th>Source</th>
            <th>Submitted At</th>
            <th>Status</th>
            <th width="170">Actions</th>
        </tr>

    </thead>

    <tbody class="text-sm">

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
                <form action="{{ route('admin.submit_emails.destroy', $submitEmail->id) }}" method="POST" class="inline-block">

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

<!-- Create Submit Email Modal -->
<div class="modal fade"
     id="createSubmitEmailModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h3 class="fw-bold mb-1">
                        Create Subscriber
                    </h3>

                    <p class="text-muted mb-0">
                        Add a new email subscriber manually.
                    </p>

                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form action="{{ route('admin.submit_emails.store') }}"
                      method="POST">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8">

                            <div class="admin-card">

                                <h6 class="admin-card-title">
                                    Subscriber Information
                                </h6>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control admin-input" placeholder="example@email.com" required>

                                </div>

                                <div>

                                    <label class="form-label">
                                        Source
                                    </label>

                                    <input type="text" name="source" value="{{ old('source') }}" class="form-control admin-input" placeholder="footer, popup, landing-page...">

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <div class="admin-card">

                                <h6 class="admin-card-title">
                                    Processing Status
                                </h6>

                                <div>

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select name="status"
                                            class="form-select">

                                        <option value="pending">
                                            Pending
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

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                                class="btn btn-primary px-4">

                            Create Subscriber

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection