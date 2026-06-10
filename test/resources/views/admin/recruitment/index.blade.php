@extends('admin.layout')

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
            @foreach ($recruitments as $recruitment)
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
                            <span
                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Paused</span>
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

                        <form action="{{ route('admin.recruitments.destroy', $recruitment->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('Delete this recruitment?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Detail Recruitment Modal -->
                <div class="modal fade" id="detailRecruitmentModal{{ $recruitment->id }}" tabindex="-1"
                    aria-hidden="true">

                    <div class="modal-dialog modal-xl modal-dialog-centered">

                        <div class="modal-content admin-modal border-0 rounded-4 overflow-hidden">

                            <!-- HEADER -->
                            <div class="modal-header">

                                <div class="d-flex align-items-center gap-4">

                                    <div class="modal-icon bg-primary-subtle text-primary">

                                        <i class="bi bi-briefcase-fill"></i>

                                    </div>

                                    <div class="flex-grow-1">

                                        <div class="d-flex align-items-center gap-2 flex-wrap mb-2">

                                            <span class="detail-id">
                                                #{{ $recruitment->id }}
                                            </span>

                                            @if ($recruitment->status == 'open')
                                                <span class="badge bg-success">
                                                    Open
                                                </span>
                                            @elseif($recruitment->status == 'paused')
                                                <span class="badge bg-warning text-dark">
                                                    Paused
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Closed
                                                </span>
                                            @endif

                                            @if ($recruitment->is_visible)
                                                <span class="badge bg-info">
                                                    Visible
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Hidden
                                                </span>
                                            @endif

                                        </div>

                                        <h2 class="mb-2 fw-bold text-black">
                                            {{ $recruitment->position }}
                                        </h2>

                                        <p class="text-gray mb-0">
                                            {{ $recruitment->location }}
                                        </p>

                                    </div>

                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <!-- BODY -->
                            <div class="modal-body p-4">

                                <!-- QUICK STATS -->
                                <div class="row g-3 mb-4">

                                    <div class="col-md-3">

                                        <div class="detail-stat-card">

                                            <i class="bi bi-geo-alt-fill"></i>

                                            <span>Location</span>

                                            <strong>
                                                {{ $recruitment->location }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="detail-stat-card">

                                            <i class="bi bi-clock-fill"></i>

                                            <span>Work Type</span>

                                            <strong>
                                                {{ ucfirst($recruitment->work_type) }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="detail-stat-card">

                                            <i class="bi bi-calendar-event-fill"></i>

                                            <span>Deadline</span>

                                            <strong>
                                                {{ $recruitment->application_deadline
                                                    ? \Carbon\Carbon::parse($recruitment->application_deadline)->format('d M Y')
                                                    : 'N/A' }}
                                            </strong>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="detail-stat-card">

                                            <i class="bi bi-eye-fill"></i>

                                            <span>Visibility</span>

                                            <strong>
                                                {{ $recruitment->is_visible ? 'Visible' : 'Hidden' }}
                                            </strong>

                                        </div>

                                    </div>

                                </div>

                                <!-- Main Content -->
                                <div class="d-flex flex-column gap-4 mb-4">

                                    <div class="admin-card">
                                        <h5 class="admin-card-title">
                                            📋 Job Description
                                        </h5>

                                        {!! $recruitment->description !!}
                                    </div>

                                    <div class="admin-card">
                                        <h5 class="admin-card-title">
                                            ⏱️ Work Times
                                        </h5>

                                        {{ $recruitment->work_time }}
                                    </div>

                                    <div class="admin-card">
                                        <h5 class="admin-card-title">
                                            📚 Requirements
                                        </h5>

                                        {!! $recruitment->requirements !!}
                                    </div>

                                    <div class="admin-card">
                                        <h5 class="admin-card-title">
                                            🎁 Benefits
                                        </h5>

                                        {!! $recruitment->benefits !!}
                                    </div>

                                </div>

                                <!-- SEO -->
                                <div class="row g-4 mb-4">

                                    <div class="col-md-6">

                                        <div class="admin-card h-100">

                                            <h6 class="admin-card-title">
                                                SEO Title
                                            </h6>

                                            <p class="mb-0">
                                                {{ $blog->seo_title ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="admin-card h-100">

                                            <h6 class="admin-card-title">
                                                SEO Description
                                            </h6>

                                            <p class="mb-0">
                                                {{ $blog->seo_description ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="modal-footer border-0">

                                <button class="btn btn-warning text-white" data-bs-toggle="modal"
                                    data-bs-target="#editRecruitmentModal{{ $recruitment->id }}">

                                    <i class="bi bi-pencil-square me-2"></i>

                                    Edit Recruitment

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Edit Recruitment Modal -->
                <div class="modal fade" id="editRecruitmentModal{{ $recruitment->id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">

                        <div class="modal-content admin-modal">

                            <!-- HEADER -->
                            <div class="modal-header border-0 pb-0">

                                <div>

                                    <h3 class="fw-bold mb-1">
                                        Update Recruitment
                                    </h3>

                                    <p class="text-muted mb-0">
                                        Update the job position.
                                    </p>

                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>

                            </div>

                            <!-- BODY -->
                            <div class="modal-body">

                                <form action="{{ route('admin.recruitments.update', $recruitment->id) }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')

                                    <div class="row g-4">

                                        <!-- LEFT -->
                                        <div class="col-lg-8 d-flex">
                                            <div class="admin-card content-card flex-grow-1">

                                                <div class="d-flex align-items-center gap-3 mb-4">

                                                    <div class="admin-icon-box">
                                                        <i class="bi bi-briefcase"></i>
                                                    </div>

                                                    <div>

                                                        <h6 class="mb-1 fw-bold">
                                                            Recruitment Information
                                                        </h6>

                                                        <small class="text-muted">
                                                            Details
                                                        </small>

                                                    </div>

                                                </div>

                                                <!-- POSITION -->
                                                <div class="mb-4">

                                                    <label class="form-label fw-semibold">
                                                        Position
                                                    </label>

                                                    <input type="text" name="position"
                                                        value="{{ old('position', $recruitment->position) }}"
                                                        class="form-control admin-input" required>

                                                </div>

                                                <!-- DESCRIPTION -->
                                                <div class="mb-4 editor-wrapper">

                                                    <label class="form-label fw-semibold">
                                                        Job Description
                                                    </label>

                                                    <textarea name="description" class="ckeditor" data-folder="recruitments">{{ old('description', $recruitment->description) }}</textarea>

                                                </div>

                                                <!-- REQUIREMENTS -->
                                                <div class="mb-4 editor-wrapper">

                                                    <label class="form-label fw-semibold">
                                                        Requirements
                                                    </label>

                                                    <textarea name="requirements" class="ckeditor" data-folder="recruitments">{{ old('requirements', $recruitment->requirements) }}</textarea>

                                                </div>

                                                <!-- BENEFITS -->
                                                <div class="editor-wrapper">

                                                    <label class="form-label fw-semibold">
                                                        Benefits
                                                    </label>

                                                    <textarea name="benefits" class="ckeditor" data-folder="recruitments">{{ old('benefits', $recruitment->benefits) }}</textarea>

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

                                                    <textarea type="text" name="location" value="{{ old('location', $recruitment->location) }}" class="form-control"
                                                        required></textarea>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Working Time
                                                    </label>

                                                    <textarea type="text" name="work_time" value="{{ old('work_time', $recruitment->work_time) }}"
                                                        class="form-control" placeholder="Mon - Fri, 08:00 - 17:00" required></textarea>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Work Type
                                                    </label>

                                                    <select name="work_type" class="form-select">

                                                        <option value="full-time"
                                                            {{ old('work_type', $recruitment->work_type) == 'full-time' ? 'selected' : '' }}>
                                                            Full-time</option>
                                                        <option value="part-time"
                                                            {{ old('work_type', $recruitment->work_type) == 'part-time' ? 'selected' : '' }}>
                                                            Part-time</option>
                                                        <option value="remote"
                                                            {{ old('work_type', $recruitment->work_type) == 'remote' ? 'selected' : '' }}>
                                                            Remote</option>
                                                        <option value="hybrid"
                                                            {{ old('work_type', $recruitment->work_type) == 'hybrid' ? 'selected' : '' }}>
                                                            Hybrid</option>

                                                    </select>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Status
                                                    </label>

                                                    <select name="status" class="form-select">

                                                        <option value="open"
                                                            {{ old('status', $recruitment->status) == 'open' ? 'selected' : '' }}>
                                                            Open</option>
                                                        <option value="paused"
                                                            {{ old('status', $recruitment->status) == 'paused' ? 'selected' : '' }}>
                                                            Paused</option>
                                                        <option value="closed"
                                                            {{ old('status', $recruitment->status) == 'closed' ? 'selected' : '' }}>
                                                            Closed</option>

                                                    </select>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Deadline
                                                    </label>

                                                    <input type="datetime-local" name="application_deadline"
                                                        class="form-control"
                                                        value="{{ old('application_deadline', $recruitment->application_deadline) }}">

                                                </div>

                                                <div>

                                                    <label class="form-label">
                                                        Visibility
                                                    </label>

                                                    <select name="is_visible" class="form-select">

                                                        <option value="1"
                                                            {{ old('is_visible', $recruitment->is_visible) == 1 ? 'selected' : '' }}>
                                                            Visible
                                                        </option>

                                                        <option value="0"
                                                            {{ old('is_visible', $recruitment->is_visible) == 0 ? 'selected' : '' }}>
                                                            Hidden
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>

                                            <!-- THUMBNAIL -->
                                            <div class="admin-card mb-4">

                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Current Thumbnail
                                                    </label>

                                                    @if ($recruitment->thumbnail)
                                                        <div class="mb-2">
                                                            <img src="{{ Storage::url($recruitment->thumbnail) }}"
                                                                class="img-fluid rounded border" style="max-height:150px">
                                                        </div>
                                                    @else
                                                        <p class="text-muted">No thumbnail uploaded</p>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Replace Thumbnail
                                                    </label>

                                                    <input type="file" name="thumbnail" class="form-control">
                                                </div>

                                                <div>
                                                    <label class="form-label">
                                                        Replace Thumbnail
                                                    </label>

                                                    <input type="text" name="thumbnail_alt"
                                                        value="{{ old('thumbnail_alt', $recruitment->thumbnail_alt) }}"
                                                        class="form-control" placeholder="Thumbnail alt text">
                                                </div>
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

                                                    <input type="text" name="seo_title"
                                                        value="{{ old('seo_title', $recruitment->seo_title) }}"
                                                        class="form-control">

                                                </div>

                                                <div>

                                                    <label class="form-label">
                                                        SEO Description
                                                    </label>

                                                    <textarea name="seo_description" rows="4" class="form-control">{{ old('seo_description', $recruitment->seo_description) }}</textarea>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="d-flex justify-content-end gap-2 mt-4">

                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit" class="btn btn-primary px-4">

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

                    <form action="{{ route('admin.recruitments.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row g-4">

                            <!-- LEFT -->
                            <div class="col-lg-8 d-flex">
                                <div class="admin-card content-card flex-grow-1">

                                    <div class="d-flex align-items-center gap-3 mb-4">

                                        <div class="admin-icon-box">
                                            <i class="bi bi-briefcase"></i>
                                        </div>

                                        <div>

                                            <h6 class="mb-1 fw-bold">
                                                Recruitment Information
                                            </h6>

                                            <small class="text-muted">
                                                Details
                                            </small>

                                        </div>

                                    </div>

                                    <!-- POSITION -->
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">
                                            Position
                                        </label>

                                        <input type="text" name="position" value="{{ old('position') }}"
                                            class="form-control admin-input" required>

                                    </div>

                                    <!-- DESCRIPTION -->
                                    <div class="mb-4 editor-wrapper">

                                        <label class="form-label fw-semibold">
                                            Job Description
                                        </label>

                                        <textarea name="description" class="ckeditor" data-folder="recruitments">{{ old('description') }}</textarea>

                                    </div>

                                    <!-- REQUIREMENTS -->
                                    <div class="mb-4 editor-wrapper">

                                        <label class="form-label fw-semibold">
                                            Requirements
                                        </label>

                                        <textarea name="requirements" class="ckeditor" data-folder="recruitments">{{ old('requirements') }}</textarea>

                                    </div>

                                    <!-- BENEFITS -->
                                    <div class="editor-wrapper">

                                        <label class="form-label fw-semibold">
                                            Benefits
                                        </label>

                                        <textarea name="benefits" class="ckeditor" data-folder="recruitments">{{ old('benefits') }}</textarea>

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

                                        <textarea type="text" name="location" value="{{ old('location') }}" class="form-control" required></textarea>

                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Working Time
                                        </label>

                                        <textarea type="text" name="work_time" value="{{ old('work_time') }}" class="form-control"
                                            placeholder="Mon - Fri, 08:00 - 17:00" required></textarea>

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

                                        <input type="file" name="thumbnail" class="form-control" required>

                                    </div>

                                    <input type="text" name="thumbnail_alt" class="form-control"
                                        placeholder="Thumbnail alt text">

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

                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">

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
