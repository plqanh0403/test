@extends('viewer.layout')

@section('title', 'Careers - EGEAD')
@section('description', 'Join EGEAD and build your career with exciting opportunities in technology.')

@section('content')

<section class="services-page">
    <div class="container">

        <!-- HEADER -->
        <div class="section-heading">
            <span class="section-badge">Careers</span>

            <h2>Join Our Team</h2>

            <p>
                Explore exciting career opportunities and grow with EGEAD.
            </p>
        </div>

        <!-- GRID -->
        <div class="row g-4">

            @foreach($recruitments as $job)
                <div class="col-lg-4 col-md-6">

                    <a href="{{ route('viewer.recruitments.show', $job->id) }}"
                       class="recruitment-card">

                        <!-- TOP -->
                        <div class="recruitment-top">
                            <span class="badge-type {{ $job->work_type }}">
                                {{ strtoupper($job->work_type) }}
                            </span>

                            <span class="badge-status">
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>

                        <!-- CONTENT -->
                        <h3>{{ $job->position }}</h3>

                        <p>
                            {{ Str::limit($job->description, 100) }}
                        </p>

                        <!-- META -->
                        <div class="recruitment-meta">
                            <span><i class="bi bi-geo-alt"></i> {{ $job->location }}</span>

                            @if($job->application_deadline)
                                <span>
                                    <i class="bi bi-calendar"></i>
                                    {{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}
                                </span>
                            @endif
                        </div>

                        <span class="service-read">
                            Apply Now <i class="bi bi-arrow-right"></i>
                        </span>

                    </a>

                </div>
            @endforeach

        </div>

    </div>
</section>

@endsection
