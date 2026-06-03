@extends('viewer.layout')

@section('title', $serviceCategory->name . ' - EGEAD')
@section('description', 'Explore ' . $serviceCategory->name . ' by EGEAD')

@section('content')

<section class="services-page">
    <div class="container">

        <!-- HEADER -->
        <div class="section-heading">
            <span class="section-badge">{{ $serviceCategory->name }}</span>

            <h2>
                Our {{ $serviceCategory->name }} Services
            </h2>

            <p>
                We provide high-quality {{ strtolower($serviceCategory->name) }} solutions
                tailored for your business growth.
            </p>
        </div>

        <!-- GRID -->
        <div class="row g-4">

            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">

                    <a href="{{ route('viewer.services.show', $service->slug) }}" class="service-card-v2">

                        <div class="service-icon">
                            <i class="{{ $service->icon }}"></i>
                        </div>

                        <h3>{{ $service->name }}</h3>

                        <p>
                            {{ Str::limit($service->description, 100) }}
                        </p>

                        <span class="service-read">
                            View Details <i class="bi bi-arrow-right"></i>
                        </span>

                    </a>

                </div>
            @endforeach

        </div>

    </div>
</section>

@endsection
