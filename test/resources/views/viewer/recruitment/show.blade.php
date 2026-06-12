@extends('viewer.layout')

@section('title', $recruitment->seo_title ?? $recruitment->position . ' - EGEAD')
@section('description', $recruitment->seo_description ?? Str::limit(strip_tags($recruitment->description), 150))

@section('content')

<section class="job-detail-page">

    <div class="container">

        {{-- HERO --}}
        <div class="job-hero">

            <div class="job-hero-content">

                <div class="job-badges">

                    <span class="job-status">
                        {{ strtoupper($recruitment->status) }}
                    </span>

                </div>

                <h1>
                    {{ $recruitment->position }}
                </h1>

                <div class="job-meta">

                    <span>
                        <i class="bi bi-geo-alt"></i>
                        {{ $recruitment->location }}
                    </span>

                    @if($recruitment->application_deadline)
                    <span>
                        <i class="bi bi-hourglass-split"></i>
                        {{ $recruitment->application_deadline ? \Carbon\Carbon::parse($recruitment->application_deadline)->format('d M Y') : "Open until filled" }}
                    </span>
                    @endif

                </div>

                <a href="#apply" class="consultation-btn">
                    Apply Now
                </a>

            </div>

            <div class="job-hero-image">

                <img src="{{ Storage::url($recruitment->thumbnail) }}" alt="{{ $recruitment->thumbnail_alt ?? $recruitment->position }}">

            </div>

        </div>

        {{-- OVERVIEW --}}
        <div class="job-overview">

            <div class="overview-item">

                <div class="overview-icon location-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div>
                    <span>Location</span>
                    <h5>{{ $recruitment->location }}</h5>
                </div>

            </div>

            <div class="overview-item">

                <div class="overview-icon briefcase-icon">
                    <i class="bi bi-briefcase"></i>
                </div>

                <div>
                    <span>Work Type</span>
                    <h5>{{ ucfirst($recruitment->work_type) }}</h5>
                </div>

            </div>

            <div class="overview-item">

                <div class="overview-icon deadline-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <span>Deadline</span>
                    <h5>
                        {{ $recruitment->application_deadline ? \Carbon\Carbon::parse($recruitment->application_deadline)->format('d M Y') : "Open until filled" }}
                    </h5>
                </div>

            </div>

            <div class="overview-item">

                <div class="overview-icon status">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div>
                    <span>Status</span>
                    <h5>{{ ucfirst($recruitment->status) }}</h5>
                </div>

            </div>

        </div>

        {{-- MAIN --}}
        <div class="job-layout">

            {{-- LEFT --}}
            <div class="job-main">

                <div class="job-card">

                    <h4>📋 Job Description</h4>

                    {!! $recruitment->description !!}

                </div>

                <div class="job-card">

                    <h4>🕰️ Working time</h4>

                    {!! $recruitment->work_time !!}

                </div>

                <div class="job-card">

                    <h4>📚 Requirements</h4>

                    {!! $recruitment->requirements !!}

                </div>

                <div class="job-card">

                    <h4>🎁 Benefits</h4>

                    {!! $recruitment->benefits !!}

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="job-sidebar">

                <div class="job-sidebar-card apply-card" id="apply">

                    <div class="apply-icon">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>

                    <h3>Ready to Join E-GEAD?</h3>

                    <p>
                        Become part of a team that values innovation, collaboration,
                        and continuous growth. Your next opportunity starts here.
                    </p>

                    <div class="apply-features">

                        <div class="apply-feature">
                            <i class="bi bi-check2-circle"></i>
                            Career Growth
                        </div>

                        <div class="apply-feature">
                            <i class="bi bi-check2-circle"></i>
                            Competitive Benefits
                        </div>

                        <div class="apply-feature">
                            <i class="bi bi-check2-circle"></i>
                            Flexible Environment
                        </div>

                    </div>

                    <a href="{{ route('viewer.contact') }}"
                        class="apply-btn-card">
                        Apply Now
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                {{-- <div class="job-sidebar-card">

                    <h3>Job Summary</h3>

                    <div class="summary-grid">

                        <div class="summary-box location">

                            <div class="summary-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <span>Location</span>

                            <h5>{{ $recruitment->location }}</h5>

                        </div>

                        <div class="summary-box type">

                            <div class="summary-icon">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>

                            <span>Work Type</span>

                            <h5>{{ ucfirst($recruitment->work_type) }}</h5>

                        </div>

                        <div class="summary-box deadline">

                            <div class="summary-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <span>Deadline</span>

                            <h5>
                                {{ \Carbon\Carbon::parse($recruitment->application_deadline)->format('d M Y') }}
                            </h5>

                        </div>

                        <div class="summary-box status">

                            <div class="summary-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <span>Status</span>

                            <h5>{{ ucfirst($recruitment->status) }}</h5>

                        </div>

                    </div>

                </div> --}}

                <div class="job-sidebar-card contact-hr-card">

                    <h3>Contact HR</h3>

                    <p>Need more information?</p>

                    <div class="contact-item">
                        <i class="bi bi-envelope"></i>
                        <span>{{ $about_us->hr_email }}</span>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <span>{{ $about_us->hr_phone }}</span>
                    </div>

                </div>

            </div>

        </div>

        {{-- RELATED JOBS --}}
        @if($relatedJobs->count())

        <div class="related-jobs">

            <h2>Other Opportunities</h2>

            <div class="row g-4">

                @foreach($relatedJobs as $job)
                <div class="col-lg-4">

                    <a href="{{ route('viewer.recruitments.show', $job->slug) }}" class="recruitment-card">

                        <div class="recruitment-thumbnail">

                            <img src="{{ Storage::url($job->thumbnail) }}" alt="{{ $job->position }}">

                            <span class="job-type">
                                {{ strtoupper($job->work_type) }}
                            </span>

                        </div>

                        <div class="recruitment-body">

                            <div class="job-meta">

                                <span>
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $job->location }}
                                </span>

                                @if($job->application_deadline)
                                <span>
                                    <i class="bi bi-hourglass-split"></i>
                                    {{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}
                                </span>
                                @endif

                            </div>

                            <h3>
                                {{ $job->position }}
                            </h3>

                            <p>
                                {{ Str::limit(strip_tags($job->description), 120) }}
                            </p>

                            <div class="job-footer">

                                <span class="job-status">
                                    {{ ucfirst($job->status) }}
                                </span>

                                <span class="apply-btn">
                                    Read More
                                    <i class="bi bi-arrow-right"></i>
                                </span>

                            </div>

                        </div>

                    </a>
                </div>
                @endforeach

            </div>

        </div>

        @endif

    </div>

</section>

@endsection
