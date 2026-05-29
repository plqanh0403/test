@extends('admin/layout/layoutAdmin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <!-- Left -->
        <div>
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                Submit Contact Management
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Manage all submit contacts in the system
            </p>
        </div>

        <!-- Right -->
        <div class="table-header">
            <a href="{{ route('admin.submit_contacts.export') }}" class="btn btn-primary">
                Export CSV
            </a>
        </div>
    </div>
    

    <table class="user-table">

        <thead>

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Phone</th>                
                <th>Status</th>
                <th width="215">Actions</th>
            </tr>

        </thead>

        <tbody>

            @foreach($submitContacts as $submitContact)
            
                <tr>

                    <td>{{ $submitContact->name }}</td>

                    <td>{{ $submitContact->email }}</td>

                    <td>{{ $submitContact->company }}</td>

                    <td>{{ $submitContact->phone }}</td>

                    @if ($submitContact->status === 'processing')
                        <td><span class="badge bg-blue-500 text-white px-2 py-1 rounded">Processing</span></td>
                    @elseif ($submitContact->status === 'processed')
                        <td><span class="badge bg-green-500 text-white px-2 py-1 rounded">Processed</span></td>
                    @endif

                    <td>
                        <button class="btn btn-view" data-bs-toggle="modal" data-bs-target="#detailSubmitContactModal{{ $submitContact->id }}">
                            <i class="bi bi-eye-fill"></i>
                        </button>

                        <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#updateNoteModal{{ $submitContact->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>

                        <form action="{{ route('admin.submit_contacts.destroy', $submitContact->id) }}" method="POST" class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this user?')">
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
                                            bg-red-100 text-blue-700
                                        @elseif($submitContact->status == 'processing')
                                            bg-blue-100 text-yellow-700
                                        @else
                                            bg-yellow-100 text-green-700
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
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="d-flex justify-content-end gap-1 mt-6">
                                    @if($submitContact->status == 'seen')
                                        <a href="{{ route('admin.submit_contacts.update_processing', $submitContact->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">
                                            Start Processing
                                        </a>
                                    @elseif($submitContact->status == 'processing')
                                        <a href="{{ route('admin.submit_contacts.update_processed', $submitContact->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded">
                                            Mark as Processed
                                        </a>
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
                                <form action="{{ route('admin.submit_contacts.update', $submitContact->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Internal Note -->
                                    <div>

                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            Internal Note
                                        </label>

                                        <input type="text" name="internal_note" value="{{ old('internal_note', $submitContact->internal_note) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                    </div>

                                    <!-- Footer -->
                                    <div class="d-flex justify-content-end gap-2 mt-6">
                                        <a href="{{ route('admin.submit_contacts') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                            Cancel
                                        </a>

                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
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
@endsection