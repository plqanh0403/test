@extends('admin.layout.layoutAdmin1')

@section('content')
    <x-admin.page-header title="E-GEAD Company Information"
        description="Everything about your company in one place — branding, contacts, HR information, social media and SEO settings.">

        <x-slot:action>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateAboutUsModal">

                <i class="bi bi-pencil-fill"></i>
                Edit Profile

            </button>

            <button class="btn-delete">
                <i class="bi bi-trash"></i>
                Delete
            </button>

        </x-slot:action>

    </x-admin.page-header>

    <div class="about-dashboard">

        <!-- INFO GRID -->
        <div class="dashboard-grid">

            <!-- COMPANY -->
            <div class="dashboard-card">

                <h3>
                    <i class="bi bi-building"></i>
                    Company Information
                </h3>

                <div class="info-list">

                    <div>
                        <label>Email</label>
                        <p class="content-box">{{ $about_us->email }}</p>
                    </div>

                    <div>
                        <label>Phone</label>
                        <p class="content-box">{{ $about_us->phone }}</p>
                    </div>

                    <div>
                        <label>Address</label>
                        <p class="content-box">{{ $about_us->address }}</p>
                    </div>

                </div>

            </div>

            <!-- HR -->
            <div class="dashboard-card">

                <h3>
                    <i class="bi bi-people"></i>
                    HR Contact
                </h3>

                <div class="info-list">

                    <div>
                        <label>HR Email</label>
                        <p class="content-box">{{ $about_us->hr_email }}</p>
                    </div>

                    <div>
                        <label>HR Phone</label>
                        <p class="content-box">{{ $about_us->hr_phone }}</p>
                    </div>

                </div>

            </br>

                <h3>
                    <i class="bi bi-share"></i>
                    Social Media
                </h3>

                <div class="social-grid">

                    <a href="{{ $about_us->facebook }}">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="{{ $about_us->linkedin }}">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>

                    <a href="{{ $about_us->youtube }}">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                    <a href="{{ $about_us->tiktok }}">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>

                    <a href="{{ $about_us->instagram }}">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                </div>

            </div>

        </div>

        <!-- BRANDING -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-palette"></i>
                Branding Assets
            </h3>

            <div class="branding-grid">

                <div>
                    <label>Thumbnail</label>
                    <img src="{{ Storage::url($about_us->thumbnail) }}" alt="Thumbnail">
                </div>

                <div>
                    <label>Light Logo</label>
                    <img src="{{ Storage::url($about_us->light_logo) }}" alt="Light logo">
                </div>

                <div>
                    <label>Dark Logo</label>
                    <img src="{{ Storage::url($about_us->dark_logo) }}" alt="Dark logo">
                </div>

                <div>
                    <label>Favicon</label>
                    <img src="{{ Storage::url($about_us->favicon) }}" alt="Favicon">
                </div>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-file-text"></i>
                Company Description
            </h3>

            <div class="content-box">{!! $about_us->description !!}</div>

        </div>

        <!-- MAP -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-map"></i>
                Google Map
            </h3>

            {!! $about_us->google_map !!}

        </div>

        <!-- SEO -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-search"></i>
                SEO Settings
            </h3>

            <div class="seo-grid">

                <div>
                    <label>SEO Title</label>
                    <p class="content-box">{{ $about_us->seo_title }}</p>
                </div>

                <div>
                    <label>Canonical URL</label>
                    <p class="content-box">{{ $about_us->canonical_url }}</p>
                </div>

                <div>
                    <label>SEO Description</label>
                    <p class="content-box">{{ $about_us->seo_description }}</p>
                </div>

                <div>
                    <label>Keywords</label>
                    <p class="content-box">{{ $about_us->seo_keywords }}</p>
                </div>

            </div>

        </div>

        <!-- TRACKING -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-graph-up"></i>
                Tracking & Verification
            </h3>

            <div class="tracking-box">

                <div>
                    <label>Google Site Verification</label>
                    <pre>{{ $about_us->google_site_verification }}</pre>
                </div>

                <div>
                    <label>Google Analytics</label>
                    <pre>{{ $about_us->google_analytics }}</pre>
                </div>

                <div>
                    <label>Meta Pixel</label>
                    <pre>{{ $about_us->meta_pixel }}</pre>
                </div>

            </div>

        </div>

    </div>
@endsection
