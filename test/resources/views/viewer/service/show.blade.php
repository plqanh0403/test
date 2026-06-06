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

                <p>
                    {{ $service->overview }}
                </p>

                <a
                    href="{{ route('viewer.contact') }}"
                    class="consultation-btn"
                >
                    Get Free Consultation
                </a>

            </div>

            <div class="hero-right">

                <img
                    src="{{ asset($service->thumbnail) }}"
                    alt="{{ $service->thumbnail_alt }}"
                >

            </div>

        </section>

        <!-- OVERVIEW -->

        <section class="service-overview-box">

            <div class="overview-item">

                <h4>
                    Category
                </h4>

                <p>
                    {{ $service->serviceCategory->name }}
                </p>

            </div>

            <div class="overview-item">

                <h4>
                    Solution Type
                </h4>

                <p>
                    Professional Service
                </p>

            </div>

            <div class="overview-item">

                <h4>
                    Support
                </h4>

                <p>
                    Dedicated Team
                </p>

            </div>

        </section>

        <!-- CONTENT -->

        <div class="service-layout">

            <div class="service-main">

                <div class="content-card">

                    {!! $service->details !!}

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

                    <a
                        href="{{ route('viewer.contact') }}"
                        class="consultation-btn"
                    >
                        Contact Us
                    </a>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsections
