@extends('viewer.layout')

@section('title', $service->seo_title ?? $service->name)
@section('description', $service->seo_description)

@section('content')

    <section class="service-detail-page">
        <div class="container">
            <section class="service-detail-hero">

                <div class="hero-left">

                    <span class="section-badge">
                        {{ $service->serviceCategory->name }}
                    </span>

                    <h1>
                        {{ $service->name }}
                    </h1>

                    <p class="hero-description">
                        {{ $service->overview }}
                    </p>

                    <div class="hero-metrics">

                        <div class="metric">

                            <strong>99.9%</strong>

                            <span>System Reliability</span>

                        </div>

                        <div class="metric">

                            <strong>24/7</strong>

                            <span>Technical Support</span>

                        </div>

                        <div class="metric">

                            <strong>Enterprise</strong>

                            <span>Ready Solution</span>

                        </div>

                    </div>

                    <div class="hero-actions">

                        <a href="{{ route('viewer.contact') }}" class="consultation-btn">
                            Get Free Consultation
                        </a>

                        <a href="#service-content" class="hero-link">

                            Learn More

                            <i class="bi bi-arrow-down"></i>

                        </a>

                    </div>

                </div>

                <div class="hero-right">

                    <img src="{{ asset($service->thumbnail) }}" alt="{{ $service->thumbnail_alt }}">

                </div>

            </section>

            <!-- OVERVIEW -->

            <section class="service-highlights">

                <div class="highlight-card">

                    <i class="bi bi-layers"></i>

                    <h4>Category</h4>

                    <p>{{ $service->serviceCategory->name }}</p>

                </div>

                <div class="highlight-card">

                    <i class="bi bi-lightning-charge"></i>

                    <h4>Solution Type</h4>

                    <p>Professional Service</p>

                </div>

                <div class="highlight-card">

                    <i class="bi bi-headset"></i>

                    <h4>Support</h4>

                    <p>Dedicated Team</p>

                </div>

            </section>

            <!-- CONTENT -->

            <div class="service-layout">

                <div class="service-main">

                    <h2>📑 Service Details</h2>

                    <div class="content-card">

                        {!! nl2br(e($service->details)) !!}

                    </div>

                </div>

                <aside class="service-sidebar">

                    <div class="sidebar-card cta">

                        <h3>
                            Ready To Start?
                        </h3>

                        <p>
                            Let's discuss your project and build the best solution together.
                        </p>

                        <a href="{{ route('viewer.contact') }}" class="consultation-light-btn">
                            Contact Us
                        </a>

                    </div>

                </aside>

            </div>
        </div>
    </section>

@endsection
