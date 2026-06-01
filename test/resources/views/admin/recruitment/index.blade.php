@extends('admin.layout.layoutAdmin1')

@section('content')
<x-admin.page-header
    title="Recruitment Management"
    description="Manage all recruitment opportunities in the system"
>
    <x-slot:action>
        <button
            class="btn btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createRecruitmentModal">

            + Create Recruitment

        </button>
    </x-slot:action>

</x-admin.page-header>

<!-- Search & Filter -->
<div class="bg-white shadow-sm rounded-4 p-4 mb-4 border">

    <form action="{{ route('admin.recruitments') }}" method="GET">

        <div class="row g-3 align-items-end">

            <!-- Search -->
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Search Contact
                </label>

                <div class="input-group search-box">
                    <i class="bi bi-search text-muted p-2"></i>

                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name, email, phone, company..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Work Type -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Work Type
                </label>

                <select name="status" class="form-control filter-select p-2 text-secondary">
                    <option value="">All Type</option>

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
                </select>
            </div>

            <!-- Status -->
            <div class="col-lg-2">
                <label class="form-label fw-semibold text-secondary mb-2">
                    Status
                </label>

                <select name="status" class="form-control filter-select p-2 text-secondary">
                    <option value="">-- Select --</option>

                    <option value="new" {{ request('status') == 'open' ? 'selected' : '' }}>
                        Open
                    </option>

                    <option value="seen" {{ request('status') == 'paused' ? 'selected' : '' }}>
                        Paused
                    </option>

                    <option value="processed" {{ request('status') == 'closed' ? 'selected' : '' }}>
                        Closed
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

                    <a href="{{ route('admin.recruitments') }}" class="btn btn-outline-secondary btn-reset text-dark d-flex align-items-center justify-content-center">
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

                                <textarea id="seo_description" name="seo_description" class="form-input" rows="4" >{{ old('seo_description', $recruitment->seo_description) }}</textarea>

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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h4 class="modal-title fw-bold text-dark mb-1">Create Recruitment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 pb-4">
                <form action="{{ route('admin.recruitments.store') }}" method="POST">
                    @csrf

                    <!-- Position -->
                    <div class="form-group">

                        <x-input-label for="position" :value="__('Position')" />

                        <x-text-input id="position" class="form-input" type="text" name="position" :value="old('position') ?? ''"
                            required autofocus autocomplete="name" />

                        <x-input-error :messages="$errors->get('position')" class="form-error" />

                    </div>

                    <!-- Description -->
                    <div class="form-group">

                        <x-input-label for="description" :value="__('Description')" />

                        <textarea id="description" name="description" class="form-input" rows="4"
                            required>{{ old('description') }}</textarea>

                        <x-input-error :messages="$errors->get('description')" class="form-error" />

                    </div>

                    <!-- Requirements -->
                    <div class="form-group">

                        <x-input-label for="requirements" :value="__('Requirements')" />

                        <textarea id="requirements" name="requirements" class="form-input" rows="4"
                            required>{{ old('requirements') }}</textarea>

                        <x-input-error :messages="$errors->get('requirements')" class="form-error" />

                    </div>

                    <!-- Benefits -->
                    <div class="form-group">

                        <x-input-label for="benefits" :value="__('Benefits')" />

                        <textarea id="benefits" name="benefits" class="form-input" rows="4"
                            required>{{ old('benefits') }}</textarea>

                        <x-input-error :messages="$errors->get('benefits')" class="form-error" />
                    </div>


                    <!-- Location -->
                    <div class="form-group">

                        <x-input-label for="location" :value="__('Location')" />

                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                            class="form-input" required>

                        <x-input-error :messages="$errors->get('location')" class="form-error" />
                    </div>

                    <!-- Work Type -->
                    <div class="form-group">

                        <x-input-label for="work_type" :value="__('Work Type')" />

                        <select id="work_type" name="work_type" class="form-input" required>
                            <option value="">Select Work Type</option>

                            <option value="full-time" {{ old('work_type') == 'full-time' ? 'selected' : '' }}>Full Time
                            </option>

                            <option value="part-time" {{ old('work_type') == 'part-time' ? 'selected' : '' }}>Part Time
                            </option>

                            <option value="remote" {{ old('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>

                            <option value="hybrid" {{ old('work_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>

                        <x-input-error :messages="$errors->get('work_type')" class="form-error" />

                    </div>

                    <!-- SEO Title -->
                    <div class="form-group">

                        <x-input-label for="seo_title" :value="__('SEO Title')" />

                        <x-text-input id="seo_title" class="form-input" type="text" name="seo_title"
                            value="{{ old('seo_title') ?? '' }}" />

                        <x-input-error :messages="$errors->get('seo_title')" class="form-error" />

                    </div>

                    <!-- SEO Description -->
                    <div class="form-group">

                        <x-input-label for="seo_description" :value="__('SEO Description')" />

                        <textarea id="seo_description" name="seo_description" class="form-input" rows="4">{{ old('seo_description') }}</textarea>

                        <x-input-error :messages="$errors->get('seo_description')" class="form-error" />
                    </div>

                    <!-- Footer -->

                    <div class="d-flex justify-content-end gap-2">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success">
                            Create Recruitment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
