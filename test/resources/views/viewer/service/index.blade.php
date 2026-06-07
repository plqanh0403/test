@extends('viewer.layout')

@section('title', $serviceCategory->seo_title ?? $serviceCategory->name)
@section('description', $serviceCategory->seo_description)

@section('content')

<section class="services-page">

    <div class="container">

        <section class="service-category-hero">

            <div class="hero-content">

                <span class="section-badge">
                    Service Category
                </span>

                <h1>
                    {{ $serviceCategory->name }}
                </h1>

                <p>
                    {{ $serviceCategory->description }}
                </p>

                <div class="hero-stat">

                    <strong>
                        {{ $services->count() }}
                    </strong>

                    <span>
                        Services Available
                    </span>

                </div>

            </div>

            <div class="hero-image">

                <img
                    src="{{ asset($serviceCategory->banner_image) }}"
                    alt="{{ $serviceCategory->name }}">

            </div>

        </section>

        <div class="section-heading">

            <span class="section-badge">
                Expertise
            </span>

            <h2>
                Our Solutions
            </h2>

        </div>

        <div class="row g-4">

            @foreach($services as $service)

            <div class="col-lg-4 col-md-6">

                <a href="{{ route('viewer.services.show',$service->slug) }}" class="service-card-v3">

                    <div class="service-thumb">

                        <img
                            src="{{ asset($service->thumbnail) }}"
                            alt="{{ $service->thumbnail_alt }}">

                    </div>

                    <div class="service-body">

                        <h3>
                            {{ $service->name }}
                        </h3>

                        <p>
                            {{ Str::limit($service->overview,120) }}
                        </p>

                        <span class="explore-btn">

                            Explore Service

                            <i class="bi bi-arrow-right"></i>

                        </span>

                    </div>

                </a>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection