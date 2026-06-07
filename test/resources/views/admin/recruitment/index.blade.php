@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header title="Recruitment Management" description="Manage all recruitment opportunities in the system">
    <x-slot:action>
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createRecruitmentModal">
            + Create Recruitment
        </button>
    </x-slot:action>
</x-admin.page-header>

<x-admin.search-box :route="route('admin.recruitments')" placeholder="Search by position, location...">
    <x-admin.filter-box box_name="Work Type" select_name='work_type'>
        <option value="">-- Select --</option>

        <option value="new" {{ request('status') == 'full-time' ? 'selected' : '' }}>
            Full-time
        </option>

        <option value="seen" {{ request('status') == 'part-time' ? 'selected' : '' }}>
            Part-time
        </option>

        <option value="processed" {{ request('status') == 'remote' ? 'selected' : '' }}>
            Remote
        </option>

        <option value="processed" {{ request('status') == 'hybrid' ? 'selected' : '' }}>
            Hybrid
        </option>
    </x-admin.filter-box>

    <x-admin.filter-box box_name="Status" select_name='status'>
        <option value="">
            -- Select --
        </option>

        <option value="new" {{ request('status') == 'open' ? 'selected' : '' }}>
            Open
        </option>

        <option value="seen" {{ request('status') == 'paused' ? 'selected' : '' }}>
            Paused
        </option>

        <option value="processed" {{ request('status') == 'closed' ? 'selected' : '' }}>
            Closed
        </option>
    </x-admin.filter-box>
</x-admin.search-box>

<table class="index-table">
    <thead class="table-header">
        <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Location</th>
            <th>Work Type</th>
            <th>Status</th>
            <th width="215">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($recruitments as $recruitment)
        <tr>
            <td>{{ $recruitment->id }}</td>
            <td>{{ $recruitment->position }}</td>
            <td>{{ $recruitment->location }}</td>
            <td>{{ $recruitment->work_type }}</td>

            @if ($recruitment->status === 'open')
            <td>
                <span
                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Open</span>
            </td>
            @elseif ($recruitment->status === 'paused')
            <td>
                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Paused</span>
            </td>
            @else
            <td>
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Closed</span>
            </td>
            @endif

            <td>
                <button class="btn btn-view" data-bs-toggle="modal"
                    data-bs-target="#detailRecruitmentModal{{ $recruitment->id }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </button>

                <button class="btn btn-edit" data-bs-toggle="modal"
                    data-bs-target="#editRecruitmentModal{{ $recruitment->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <form action="{{ route('admin.recruitments.destroy', $recruitment->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this recruitment?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>

        <!-- Detail Recruitment Modal -->
        <div class="modal fade" id="detailRecruitmentModal{{ $recruitment->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header flex justify-content-start items-center gap-6 mb-10 pb-0">

                        <!-- Avatar -->
                        <div
                            class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold">
                            {{ strtoupper(substr($recruitment->position, 0, 1)) }}
                        </div>

                        <!-- Recruitment Info -->
                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $recruitment->position }}
                            </h2>

                            <span class=" inline-block px-4 py-2 rounded-full text-sm font-semibold
                                        @if($recruitment->status == 'closed')
                                            bg-red-100 text-red-700
                                        @elseif($recruitment->status == 'open')
                                            bg-green-100 text-green-700
                                        @else
                                            bg-yellow-100 text-yellow-700
                                        @endif ">
                                {{ ucfirst($recruitment->status) }}
                            </span>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">

                        <!-- Recruitment Card -->
                        <div class="bg-white rounded-xl shadow p-8">

                            <!-- Detail Grid -->
                            <div class="grid grid-cols-2 gap-6">

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Recruitment ID
                                    </p>

                                    <p class="text-xl font-semibold">
                                        #{{ $recruitment->id }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Description
                                    </p>

                                    <p class="text-xl font-semibold break-all">
                                        {{ $recruitment->description }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Requirements
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->requirements }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Benefits
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->benefits }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Location
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->location }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Work Type
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->work_type }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        Application Deadline
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->application_deadline }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        SEO Title
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->seo_title }}
                                    </p>

                                </div>

                                <div class="bg-gray-100 p-5 rounded-lg">

                                    <p class="text-gray-500 text-sm mb-1">
                                        SEO Description
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $recruitment->seo_description }}
                                    </p>

                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-1 mt-6">

                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded"
                                    data-bs-toggle="modal" data-bs-target="#editRecruitmentModal{{ $recruitment->id }}">
                                    Edit Recruitment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Recruitment Modal -->
        <div class="modal fade" id="editRecruitmentModal{{ $recruitment->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <!-- Modal Header -->
                    <div class="modal-header border-0 px-4 pt-4 pb-2">
                        <h4 class="modal-title fw-bold text-dark mb-1">Edit Recruitment</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-4 pb-4">
                        <form action="{{ route('admin.recruitments.update', $recruitment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Position -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Position
                                </label>

                                <input type="text" name="position" value="{{ old('position', $recruitment->position) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Description -->
                            <div class="form-group">

                                <x-input-label for="description" :value="__('Description')" />

                                <textarea id="description" name="description" class="form-input" rows="4"
                                    required>{{ old('description', $recruitment->description) }}</textarea>

                            </div>

                            <!-- Requirements -->
                            <div class="form-group">

                                <x-input-label for="requirements" :value="__('Requirements')" />

                                <textarea id="requirements" name="requirements" class="form-input" rows="4"
                                    required>{{ old('requirements', $recruitment->requirements) }}</textarea>
                            </div>

                            <!-- Benefits -->
                            <div class="form-group">

                                <x-input-label for="benefits" :value="__('Benefits')" />

                                <textarea id="benefits" name="benefits" class="form-input" rows="4"
                                    required>{{ old('benefits', $recruitment->benefits) }}</textarea>
                            </div>

                            <!-- Location -->
                            <div class="form-group">

                                <x-input-label for="location" :value="__('Location')" />

                                <input type="text" id="location" name="location"
                                    value="{{ old('location', $recruitment->location) }}" class="form-input" required>
                            </div>

                            <!-- Work Type -->
                            <div class="form-group">

                                <x-input-label for="work_type" :value="__('Work Type')" />

                                <select id="work_type" name="work_type" class="form-input" required>
                                    <option value=""> Select Work Type </option>

                                    <option value="full-time"
                                        {{ old('work_type', $recruitment->work_type) == 'full-time' ? 'selected' : '' }}>
                                        Full Time
                                    </option>

                                    <option value="part-time"
                                        {{ old('work_type', $recruitment->work_type) == 'part-time' ? 'selected' : '' }}>
                                        Part Time
                                    </option>

                                    <option value="remote"
                                        {{ old('work_type', $recruitment->work_type) == 'remote' ? 'selected' : '' }}>
                                        Remote
                                    </option>

                                    <option value="hybrid"
                                        {{ old('work_type', $recruitment->work_type) == 'hybrid' ? 'selected' : '' }}>
                                        Hybrid
                                    </option>
                                </select>

                                <x-input-error :messages="$errors->get('work_type')" class="form-error" />

                            </div>

                            <!-- Application Deadline -->
                            <div class="form-group">

                                <x-input-label for="application_deadline" :value="__('Application Deadline')" />

                                <input type="date" id="application_deadline" name="application_deadline" value="{{ old('application_deadline', date('Y-m-d', strtotime($recruitment->application_deadline))) }}" class="form-input" required>

                            </div>

                            <!-- SEO Title -->
                            <div class="form-group">

                                <x-input-label for="seo_title" :value="__('SEO Title')" />

                                <input type="text" id="seo_title" name="seo_title"
                                    value="{{ old('seo_title', $recruitment->seo_title) }}" class="form-input">

                            </div>

                            <!-- SEO Description -->
                            <div class="form-group">

                                <x-input-label for="seo_description" :value="__('SEO Description')" />

                                <textarea id="seo_description" name="seo_description" class="form-input" rows="4">{{ old('seo_description', $recruitment->seo_description) }}</textarea>

                            </div>

                            <!-- Footer -->
                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('admin.recruitments') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-semibold">
                                    Cancel
                                </a>

                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow">
                                    Update Recruitment
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
    {{ $recruitments->links() }}
</div>

<!-- Create Recruitment Modal -->
<div class="modal fade" id="createRecruitmentModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content admin-modal">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h3 class="fw-bold mb-1">
                        Create Recruitment
                    </h3>

                    <p class="text-muted mb-0">
                        Create a new job opportunity.
                    </p>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form action="{{ route('admin.recruitments.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-8 d-flex">
                            <div class="admin-card content-card flex-grow-1">

                                <!-- POSITION -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Position
                                    </label>

                                    <input type="text" name="position" value="{{ old('position') }}" class="form-control admin-input" required>

                                </div>

                                <!-- DESCRIPTION -->
                                <div class="mb-4 editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Job Description
                                    </label>

                                    <textarea name="description" class="ckeditor">{{ old('description') }}</textarea>

                                </div>

                                <!-- REQUIREMENTS -->
                                <div class="mb-4 editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Requirements
                                    </label>

                                    <textarea name="requirements" class="ckeditor">{{ old('requirements') }}</textarea>

                                </div>

                                <!-- BENEFITS -->
                                <div class="editor-wrapper">

                                    <label class="form-label fw-semibold">
                                        Benefits
                                    </label>

                                    <textarea name="benefits" class="ckeditor">{{ old('benefits') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">

                            <!-- SETTINGS -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Recruitment Settings
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Location
                                    </label>

                                    <textarea type="text" name="location" value="{{ old('location') }}" class="form-control"></textarea>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Working Time
                                    </label>

                                    <textarea type="text" name="work_time" value="{{ old('work_time') }}" class="form-control" placeholder="Mon - Fri, 08:00 - 17:00"></textarea>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Work Type
                                    </label>

                                    <select name="work_type" class="form-select">

                                        <option value="full-time">Full-time</option>
                                        <option value="part-time">Part-time</option>
                                        <option value="remote">Remote</option>
                                        <option value="hybrid">Hybrid</option>

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select name="status" class="form-select">

                                        <option value="open">Open</option>
                                        <option value="paused">Paused</option>
                                        <option value="closed">Closed</option>

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Deadline
                                    </label>

                                    <input type="datetime-local" name="application_deadline" class="form-control">

                                </div>

                                <div>

                                    <label class="form-label">
                                        Visibility
                                    </label>

                                    <select name="is_visible" class="form-select">

                                        <option value="1">
                                            Visible
                                        </option>

                                        <option value="0">
                                            Hidden
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- THUMBNAIL -->
                            <div class="admin-card mb-4">

                                <h6 class="admin-card-title">
                                    Thumbnail
                                </h6>

                                <div class="mb-3">

                                    <input type="file" name="thumbnail" class="form-control">

                                </div>

                                <input type="text" name="thumbnail_alt" class="form-control" placeholder="Thumbnail alt text">

                            </div>

                            <!-- SEO -->
                            <div class="admin-card">

                                <h6 class="admin-card-title">
                                    SEO Settings
                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        SEO Title
                                    </label>

                                    <input type="text" name="seo_title" class="form-control">

                                </div>

                                <div>

                                    <label class="form-label">
                                        SEO Description
                                    </label>

                                    <textarea name="seo_description" rows="4" class="form-control"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit" class="btn btn-primary px-4">

                            Create Recruitment

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection