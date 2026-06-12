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
                        <a href="#details" class="why-btn down-btn">
                            Learn More
                            <i class="bi bi-arrow-down"></i>
                        </a>

                    </div>

                </div>

                <div class="hero-right">

                    <img src="{{ Storage::url($service->thumbnail) }}" alt="{{ $service->thumbnail_alt }}">

                </div>

            </section>



            <!-- CONTENT -->

            <div class="service-layout" id="details">

                <div class="service-main">

                    <h4>📑 Service Details</h4>

                    <div class="content-card">

                        <p>{!! $service->details !!}</p>

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

            <!-- OVERVIEW -->

            <section class="service-outcomes">

                <div class="outcome-card">

                    <div class="outcome-card-header">

                        <i class="bi bi-clock-history"></i>

                        <h4>
                            Save Time
                        </h4>

                    </div>

                    <p>Automate repetitive processes and reduce manual workload, allowing teams to focus on strategic priorities.</p>

                </div>

                <div class="outcome-card">

                    <div class="outcome-card-header">

                        <i class="bi bi-arrow-repeat"></i>

                        <h4>
                            Improve Accuracy
                        </h4>

                    </div>

                    <p>Eliminate data inconsistencies and minimize human errors through automated workflows and synchronization.</p>

                </div>

                <div class="outcome-card">

                    <div class="outcome-card-header">

                        <i class="bi bi-bar-chart-line"></i>

                        <h4>
                            Increase Visibility
                        </h4>

                    </div>

                    <p>
                        Gain real-time insights into operations, performance, and business activities from a centralized
                        platform.
                    </p>

                </div>

                <div class="outcome-card">

                    <div class="outcome-card-header">

                        <i class="bi bi-graph-up-arrow"></i>

                        <h4>
                            Scale With Confidence
                        </h4>

                    </div>

                    <p>
                        Build a foundation that supports growth, adapts to increasing demand, and evolves with your
                        business.
                    </p>

                </div>

            </section>

        </div>

    </section>

@endsection
