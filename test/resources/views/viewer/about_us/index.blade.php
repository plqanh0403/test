@extends('viewer.layout')

@section('title', $about_us->seo_title ?? 'About Us - EGEAD')
@section('description', $about_us->seo_description ?? $about_us->short_description)

@section('content')

<section class="about-section">
    <div class="container">

        <!-- HERO -->
        <div class="about-hero text-center">

            @if($about_us->light_logo)
                <img src="{{ asset($about_us->light_logo) }}" class="about-logo">
            @endif

            <span class="section-badge">About Us</span>

            <h1>{{ $about_us->name }}</h1>

            <p>
                {{ $about_us->short_description }}
            </p>

        </div>

        <!-- STORY -->
        <div class="about-story text-center">
            <h2>Who We Are</h2>

            <p>
                We are a technology-driven company focused on delivering scalable,
                high-quality software solutions and digital transformation strategies.
            </p>
        </div>

        <!-- INFO CARD -->
        <div class="about-info-box">

            <div class="about-info-item">
                <i class="bi bi-telephone"></i>
                <div>
                    <h5>Phone</h5>
                    <p>{{ $about_us->phone }}</p>
                </div>
            </div>

            <div class="about-info-item">
                <i class="bi bi-envelope"></i>
                <div>
                    <h5>Email</h5>
                    <p>{{ $about_us->email }}</p>
                </div>
            </div>

            <div class="about-info-item">
                <i class="bi bi-geo-alt"></i>
                <div>
                    <h5>Address</h5>
                    <p>{{ $about_us->address }}</p>
                </div>
            </div>

        </div>

        <!-- SOCIAL -->
        <div class="about-social text-center">

            <h4>Connect With Us</h4>

            <div class="social-list">
                @if($about_us->facebook)
                    <a href="{{ $about_us->facebook }}"><i class="fa-brands fa-facebook-f"></i></a>
                @endif

                @if($about_us->linkedin)
                    <a href="{{ $about_us->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>
                @endif

                @if($about_us->youtube)
                    <a href="{{ $about_us->youtube }}"><i class="fa-brands fa-youtube"></i></a>
                @endif

                @if($about_us->tiktok)
                    <a href="{{ $about_us->tiktok }}"><i class="fa-brands fa-tiktok"></i></a>
                @endif
            </div>

        </div>

        <!-- MAP -->
        @if($about_us->google_map)
            <div class="about-map">
                {!! $about_us->google_map !!}
            </div>
        @endif

    </div>
</section>

@endsection