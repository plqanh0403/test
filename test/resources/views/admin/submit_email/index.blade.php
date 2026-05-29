@extends('admin/layout/layoutAdmin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <!-- Left -->
        <div>
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                Submit Email Management
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Manage all submit emails in the system
            </p>
        </div>

        <!-- Right -->
        <div class="table-header">
            <a href="{{ route('admin.submit_emails.export') }}" class="btn btn-primary">
                Export CSV
            </a>
        </div>
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
                    <td>{{ $submitEmail->create_at }}</td>

                    @if ($submitEmail->status === 'processing')
                        <td>
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Processing</span>
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
                        <form action="{{ route('admin.submit_emails.destroy', $submitEmail->id) }}" method="POST" class="delete-form">

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
@endsection