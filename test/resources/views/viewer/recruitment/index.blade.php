@extends('viewer.layout')

@section('title', 'Careers - EGEAD')
@section('description', 'Join EGEAD and build your career with exciting opportunities in technology.')

@section('content')

<section class="recruitment-page">

    <div class="container">

        <!-- HERO -->
        <section class="career-hero">

            <div class="career-intro">

                <div class="career-intro-content">

                    <h1>
                        Why Join E-GEAD?
                    </h1>

                    <p>
                        At E-GEAD, we don’t just build systems — we create solutions that help
                        businesses grow sustainably in the global market. You’ll work in a young,
                        dynamic environment where every idea is valued and your professional
                        growth is always a priority.
                    </p>

                    <div class="career-benefits">

                        <div class="career-benefit">
                            <i class="bi bi-cash-stack"></i>
                            Competitive salary + KPI bonuses
                        </div>

                        <div class="career-benefit">
                            <i class="bi bi-laptop"></i>
                            Fully equipped working environment
                        </div>

                        <div class="career-benefit">
                            <i class="bi bi-people"></i>
                            Team building & open culture
                        </div>

                        <div class="career-benefit">
                            <i class="bi bi-graph-up-arrow"></i>
                            Clear career growth path
                        </div>

                    </div>

                </div>

                <div class="career-intro-image">

                    <img src="{{ asset('images/career-banner.jpg') }}"
                        alt="Career at EGEAD">

                </div>

            </div>

            <section class="career-highlight">

                <div class="career-highlight-left">


                    <h2>
                        Your Career <br>
                        &emsp;&emsp;Starts Here
                    </h2>

                </div>

                <div class="career-highlight-right">

                    <div class="career-highlight-badge">
                        <img src="{{ asset('images/logo.png') }}" alt="logo E-Gead">
                        <span class="text-lg">Best Career Opportunities</span>
                    </div>

                    <p>
                        Join E-GEAD and create innovative technology solutions while growing your career in a dynamic and collaborative environment.
                    </p>

                </div>

            </section>

            <div class="career-toolbar">

                <!-- LEFT -->
                <div class="career-filters">

                    <form method="GET" action="{{ route('viewer.recruitments.index') }}" class="career-search-form" id="career-search-form">

                        <div class="career-search">

                            <i class="bi bi-search"></i>

                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search by position...">

                        </div>

                        <select name="work_type" class="career-filter-select filter-select">

                            <option value="">-- All Types --</option>

                            <option value="full-time"
                                {{ request('work_type') == 'full-time' ? 'selected' : '' }}>
                                Full Time
                            </option>

                            <option value="part-time"
                                {{ request('work_type') == 'part-time' ? 'selected' : '' }}>
                                Part Time
                            </option>

                            <option value="hybrid"
                                {{ request('work_type') == 'hybrid' ? 'selected' : '' }}>
                                Hybrid
                            </option>

                            <option value="remote"
                                {{ request('work_type') == 'remote' ? 'selected' : '' }}>
                                Remote
                            </option>

                        </select>

                        <button type="submit" class="career-filter-btn">
                            <i class="bi bi-funnel"></i>
                            Filter
                        </button>

                        <a href="{{ route('viewer.recruitments.index') }}#job-list" class="career-reset-btn">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>

                    </form>

                </div>

                <!-- RIGHT -->
                <div class="career-stats">

                    <div class="career-stat">
                        <strong>{{ $recruitmentCount }}</strong>
                        <span>Open Positions</span>
                    </div>

                    <div class="career-stat">
                        <strong>100%</strong>
                        <span>Growth Mindset</span>
                    </div>

                    <div class="career-stat">
                        <strong>Tech</strong>
                        <span>Innovation Driven</span>
                    </div>

                </div>

            </div>

            <h1>
                Build The Future With EGEAD
            </h1>

            <p>
                Join our talented team and help create innovative technology solutions.
            </p>

        </section>

        <!-- JOB GRID -->
        <div class="recruitment-grid-wrapper" id="job-list">

            <div class="blog-grid-label">
                <span>
                    Careers
                </span>
            </div>

            <div class="recruitment-grid">

                @foreach($recruitments as $job)

                <a href="{{ route('viewer.recruitments.show', $job->slug) }}" class="recruitment-card">

                    <div class="recruitment-thumbnail">

                        <img src="{{ asset($job->thumbnail) }}" alt="{{ $job->position }}">

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

                            <span>
                                <i class="bi bi-hourglass-split"></i>
                                {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') : "Open until filled" }}
                            </span>

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

                @endforeach

            </div>

            <div class="recruitment-pagination-center">
                {{ $recruitments->fragment('job-list')->links() }}
            </div>

        </div>

    </div>

</section>

@endsection
