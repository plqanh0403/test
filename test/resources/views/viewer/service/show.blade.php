@extends('viewer.layout')

@section('title', $service->name . ' - EGEAD')
@section('description', $service->seo_description ?? Str::limit($service->description, 150))

@section('content')

<section class="service-detail">
    <div class="container">

        <!-- HERO -->
        <div class="service-hero">

            <div class="service-hero-content">
                <span class="section-badge">
                    {{ $service->serviceCategory->name }}
                </span>

                <h1>{{ $service->name }}</h1>

                <p>{{ $service->description }}</p>

                <a href="#" class="consultation-btn">
                    Get Free Consultation
                </a>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="service-content">

            {!! $service->content !!}

        </div>

    </div>
</section>

@endsection
