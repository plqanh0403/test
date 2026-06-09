@extends('admin.layout')

@section('content')
    <x-admin.page-header title="{{ $about_us->name }}"
        description="Everything about your company in one place — branding, contacts, HR information, social media and SEO settings.">

        <x-slot:action>

            @if (!$about_us)
                <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#aboutUsModal">

                    <i class="bi bi-plus-lg"></i>
                    Add New E-GEAD Profile

                </button>
            @else
                <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#aboutUsModal">

                    <i class="bi bi-pencil-fill"></i>
                    Edit Profile

                </button>

                <form action="{{ route('admin.about_us.destroy', $about_us) }}" method="POST"
                    onsubmit="return confirm('Delete company profile?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-delete">

                        <i class="bi bi-trash-fill"></i>
                        Delete

                    </button>

                </form>
            @endif

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

        <div class="dashboard-grid full-width">
            <!-- BRANDING -->
            <div class="dashboard-card">

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

            <!-- MAP -->
            <div class="dashboard-card">

                <h3>
                    <i class="bi bi-map"></i>
                    Google Map
                </h3>

                {!! $about_us->google_map !!}

            </div>
        </div>

        <div class="dashboard-grid full-width">

            <!-- SLOGAN -->
            <div class="dashboard-card">
                <h3>
                    <i class="bi bi-megaphone"></i>
                    Slogan
                </h3>

                <div class="content-box">{{ $about_us->slogan }}</div>
            </div>

            <!-- FOOTER TEXT -->
            <div class="dashboard-card">
                <h3>
                    <i class="bi bi-text-paragraph"></i>
                    Footer text
                </h3>

                <div class="content-box">{{ $about_us->footer_text }}</div>
            </div>
        </div>
        <!-- DESCRIPTION -->
        <div class="dashboard-card full-width">

            <h3>
                <i class="bi bi-file-text"></i>
                Company Introduction
            </h3>

            <div class="content-box">{!! $about_us->description !!}</div>

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

    <div class="modal fade" id="aboutUsModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content admin-modal">

                <div class="modal-header">

                    <div>

                        <h3 class="modal-title">{{ $about_us ? 'Update Company Profile' : 'Create Company Profile' }}</h3>

                        <p class="modal-subtitle text-muted mb-0">

                            Manage company information,
                            branding, social media and SEO.

                        </p>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ $about_us ? route('admin.about_us.update', $about_us) : route('admin.about_us.store') }}">

                        @csrf

                        @if ($about_us)
                            @method('PUT')
                        @endif

                        <div class="about-modal-layout">

                            <!-- LEFT -->

                            <div class="about-main">

                                <!-- COMPANY -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-building"></i>

                                        <div>

                                            <h5>Company Information</h5>

                                            <span>
                                                Basic company information
                                            </span>

                                        </div>

                                    </div>

                                    <div class="form-grid">

                                        <div class="form-group">
                                            <label>Name</label>

                                            <input type="text" name="name" class="form-control" value="{{ old('name', $about_us->name ?? '') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Slogan</label>

                                            <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $about_us->slogan ?? '') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>

                                            <input type="email" name="email" class="form-control" value="{{ old('email', $about_us->email ?? '') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>

                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $about_us->phone ?? '') }}">
                                        </div>

                                        <div class="form-group full">
                                            <label>Address</label>

                                            <input type="text" name="address" class="form-control" value="{{ old('address', $about_us->address ?? '') }}">
                                        </div>

                                    </div>

                                </div>

                                <!-- DESCRIPTION -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-file-earmark-text"></i>

                                        <div>

                                            <h5>Description</h5>

                                            <span>
                                                Company overview
                                            </span>

                                        </div>

                                    </div>

                                    <textarea name="description" class="form-control ckeditor">{{ old('description', $about_us->description ?? '') }}</textarea>

                                </div>

                                <!-- FOOTER -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-layout-text-sidebar"></i>

                                        <div>

                                            <h5>Footer Text</h5>

                                        </div>

                                    </div>

                                    <textarea name="footer_text" class="form-control ckeditor">{{ old('footer_text', $about_us->footer_text ?? '') }}</textarea>

                                </div>

                                <!-- MAP -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-map"></i>

                                        <div>

                                            <h5>Google Map Embed</h5>

                                        </div>

                                    </div>

                                    <textarea name="google_map" rows="8" class="form-control">{{ old('google_map', $about_us->google_map ?? '') }}</textarea>

                                </div>

                            </div>

                            <!-- RIGHT -->

                            <div class="about-sidebar">

                                <!-- BRANDING -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-palette"></i>

                                        <div>

                                            <h5>Branding Assets</h5>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Thumbnail Alt</label>
                                        <input type="text" name="thumbnail_alt" class="form-control"
                                            value="{{ old('thumbnail_alt', $about_us->thumbnail_alt ?? '') }}">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Light Logo</label>
                                        <input type="file" name="light_logo" class="form-control">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Dark Logo</label>
                                        <input type="file" name="dark_logo" class="form-control">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Favicon</label>
                                        <input type="file" name="favicon" class="form-control">
                                    </div>

                                </div>

                                <!-- SOCIAL -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-share"></i>

                                        <div>

                                            <h5>Social Media</h5>

                                        </div>

                                    </div>

                                    <label>Facebook</label>
                                    <input class="form-control mb-3" name="facebook" placeholder="Facebook URL" value="{{ old('facebook', $about_us->facebook ?? '') }}">

                                    <label>Linkedin</label>
                                    <input class="form-control mb-3" name="linkedin" placeholder="LinkedIn URL" value="{{ old('linkedin', $about_us->linkedin ?? '') }}">

                                    <label>Youtube</label>
                                    <input class="form-control mb-3" name="youtube" placeholder="Youtube URL" value="{{ old('youtube', $about_us->youtube ?? '') }}">

                                    <label>Tiktok</label>
                                    <input class="form-control  mb-3" name="tiktok" placeholder="TikTok URL" value="{{ old('tiktok', $about_us->tiktok ?? '') }}">

                                    <label>Instagram</label>
                                    <input class="form-control  mb-3" name="instagram" placeholder="Instagram URL" value="{{ old('instagram', $about_us->instagram ?? '') }}">

                                </div>

                                <!-- HR -->

                                <div class="form-card">

                                    <div class="card-header">

                                        <i class="bi bi-people"></i>

                                        <div>

                                            <h5>HR Contact</h5>

                                        </div>

                                    </div>

                                    <label>HR Email</label>
                                    <input class="form-control mb-3" name="hr_email" value="{{ old('hr_email', $about_us->hr_email ?? '') }}" placeholder="HR Email">

                                    <label>HR Phone</label>
                                    <input class="form-control" name="hr_phone" value="{{ old('hr_phone', $about_us->hr_phone ?? '') }}" placeholder="HR Phone">

                                </div>

                                <!-- SEO -->

                                <div class="form-card">

                                    <h5>SEO</h5>

                                    <input class="form-control mb-3" name="seo_title" placeholder="SEO Title"
                                        value="{{ old('seo_title', $about_us->seo_title ?? '') }}">

                                    <textarea class="form-control mb-3" rows="3" name="seo_description">{{ old('seo_description', $about_us->seo_description ?? '') }}</textarea>

                                    <textarea class="form-control mb-3" rows="3" name="seo_keywords">{{ old('seo_keywords', $about_us->seo_keywords ?? '') }}</textarea>

                                    <input class="form-control" name="canonical_url"
                                        value="{{ old('canonical_url', $about_us->canonical_url ?? '') }}">
                                </div>

                                <!-- OG -->

                                <div class="form-card">

                                    <h5>Open Graph</h5>

                                    <input class="form-control mb-3" name="og_title"
                                        value="{{ old('og_title', $about_us->og_title ?? '') }}">

                                    <textarea class="form-control mb-3" rows="3" name="og_description">{{ old('og_description', $about_us->og_description ?? '') }}</textarea>

                                    <input type="file" class="form-control" name="og_image">

                                </div>

                                <!-- TRACKING -->

                                <div class="form-card">

                                    <h5>Tracking & Verification</h5>

                                    <textarea class="form-control mb-3" rows="3" name="google_site_verification">{{ old('google_site_verification', $about_us->google_site_verification ?? '') }}</textarea>

                                    <textarea class="form-control mb-3" rows="5" name="google_analytics">{{ old('google_analytics', $about_us->google_analytics ?? '') }}</textarea>

                                    <textarea class="form-control" rows="5" name="meta_pixel">{{ old('meta_pixel', $about_us->meta_pixel ?? '') }}</textarea>

                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-primary">{{ $about_us ? 'Update Profile' : 'Create Profile' }}</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
