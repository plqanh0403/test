@extends('viewer.layout')

@section('title', $about_us->seo_title ?? 'About Us - EGEAD')
@section('description', $about_us->seo_description ?? $about_us->short_description)

@section('content')

<section class="about-section">
    <div class="container">

        <!-- HERO -->
        <div class="about-hero">

            <div class="about-hero-content">

                <span class="section-badge">
                    About Us
                </span>

                <h1>
                    {{ $about_us->name }}
                </h1>

            </div>

            @if($about_us->light_logo)
            <div class="about-hero-logo">
                <img src="{{ asset('$about_us->light_logo') }}">
            </div>
            @endif

        </div>

        <div class="about-content-layout">

            {{-- LEFT CONTENT --}}
            <div class="about-main-content">

                <h2>Who We Are</h2>

                <div class="about-description">
                    {!! $about_us->description !!}
                </div>

            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="about-sidebar">

                <div class="about-sidebar-card">

                    <h3>Company Information</h3>

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

                <div class="about-sidebar-card">

                    <h3>Connect With Us</h3>

                    <div class="social-list">

                        @if($about_us->facebook)
                        <a href="{{ $about_us->facebook }}">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        @endif

                        @if($about_us->linkedin)
                        <a href="{{ $about_us->linkedin }}">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        @endif

                        @if($about_us->youtube)
                        <a href="{{ $about_us->youtube }}">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        @endif

                        @if($about_us->tiktok)
                        <a href="{{ $about_us->tiktok }}">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        @endif

                    </div>

                    <form action=" {{ route('viewer.email.store')}}" method="POST" class="subscribe-form">
                        @csrf

                        <div class="subscribe-box">

                            <input type="email" name="email" placeholder="Enter your email..." required>

                            <input type="hidden" name="source" value="about_us">

                            <button type="submit">
                                <i class="bi bi-send"></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- MAP -->
        @if($about_us->google_map)
            <div class="about-map">
                {!! $about_us->google_map !!} {{-- Dấu !! hai đầu để chèn đoạn HTML--}}
            </div>
        @endif

    </div>
</section>

@endsection