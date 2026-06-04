@extends('viewer.layout')

@section('title', $recruitment->seo_title ?? $recruitment->position . ' - EGEAD')
@section('description', $recruitment->seo_description ?? Str::limit($recruitment->description, 150))

@section('content')

<section class="service-detail">
    <div class="container">

        <!-- HERO -->
        <div class="service-hero">

            <span class="section-badge">
                {{ strtoupper($recruitment->work_type) }}
            </span>

            <h1>{{ $recruitment->position }}</h1>

            <p>{{ $recruitment->location }}</p>

            <a href="#" class="consultation-btn">
                Apply Now
            </a>

        </div>

        <!-- CONTENT -->
        <div class="service-content">

            <h2>Job Description</h2>
            <p>{!! nl2br(e($recruitment->description)) !!}</p>

            <h2>Requirements</h2>
            <p>{!! nl2br(e($recruitment->requirements)) !!}</p>

            <h2>Benefits</h2>
            <p>{!! nl2br(e($recruitment->benefits)) !!}</p>

        </div>

        <!-- RELATED -->
        <div class="mt-5">
            <h3 class="mb-4">Other Opportunities</h3>

            <div class="row g-4">
                @foreach($relatedJobs as $job)
                    <div class="col-md-4">
                        <a href="{{ route('viewer.recruitments.show', $job->slug) }}"
                           class="recruitment-card small">

                            <h4>{{ $job->position }}</h4>
                            <p>{{ Str::limit($job->description, 80) }}</p>

                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection
