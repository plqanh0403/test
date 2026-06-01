@extends('admin/layout/layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Submit Email Management"
    description="Manage all submit emails in the system">

    <x-slot:action>
        <button class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createServiceModal">
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
@endsection
