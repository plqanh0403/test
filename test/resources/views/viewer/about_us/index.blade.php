@extends('viewer.layout')

@section('title', $about_us->seo_title ?? 'About Us - EGEAD')
@section('description', $about_us->seo_description ?? $about_us->short_description)

@section('content')

    <section class="about-page">

        {{-- HERO --}}
        <section class="about-hero">

            <div class="container">

                <span class="section-badge">
                    ABOUT E-GEAD
                </span>

                <h1>
                    Empowering Businesses Through </br>
                    <span class="text-gradient">
                        Automation & Innovation
                    </span>
                </h1>

                <p>
                    We help businesses streamline operations, automate sales processes,
                    and build scalable digital ecosystems that drive sustainable growth.
                </p>

            </div>

        </section>

        {{-- IMPACT --}}
        <section class="impact-section">

            <div class="container">

                <div class="row">

                    <div class="col-md-3 text-center">
                        <h1>100+</h1>
                        <p>Projects Delivered</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <h1>20+</h1>
                        <p>Business Partners</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <h1>10+</h1>
                        <p>Countries Reached</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <h1>99%</h1>
                        <p>Client Satisfaction</p>
                    </div>

                </div>

            </div>

        </section>

        {{-- OUR STORY --}}
        <section class="about-story">

            <div class="container">

                <div class="row align-items-center g-5">

                    <div class="col-lg-6">

                        <h2 class="text-gradient">Our Story</h2>

                        <p>
                            Not every journey is measured by the miles we travel.

                            Some journeys are defined by the moments we share,
                            the challenges we overcome,
                            and the memories we create together.

                            It's not about how far we go,
                            but about the courage to take the first step,
                            the laughter that echoes through the mountains,
                            and the spirit that keeps us moving forward.

                            Because in the end,
                            the most meaningful journeys are not about the destination,
                            but about the people, the experiences,
                            and the growth we discover along the way.
                        </p>

                    </div>

                    <div class="col-lg-6">

                        <img src="{{ Storage::url('images/story.jpg') }}" class="img-fluid rounded-4">

                    </div>

                </div>

            </div>

        </section>

        {{-- WHAT WE DO --}}
        <section class="about-services">

            <div class="container">

                <div class="section-heading">

                    <span class="section-badge">
                        SERVICES
                    </span>

                    <h2>
                        Enterprise Solutions That Drive Growth
                    </h2>

                    <p>
                        From sales automation and fulfillment management to enterprise platforms and website infrastructure,
                        we help organizations streamline operations,
                        reduce complexity, and unlock sustainable growth.
                    </p>

                </div>

                <div class="services-grid">

                    <div class="service-row">

                        <div class="service-number">01</div>

                        <div class="service-content">

                            <h4>API Integration & Fulfillment</h4>

                            <p>
                                Connect marketplaces, suppliers, logistics providers, and internal systems
                                through secure API integrations to automate order processing,
                                inventory synchronization, and fulfillment workflows.
                            </p>

                        </div>

                    </div>

                    <div class="service-row">

                        <div class="service-number">02</div>

                        <div class="service-content">

                            <h4>Website & Hosting Management System</h4>

                            <p>
                                Build, deploy, and manage business websites through a centralized
                                hosting and management platform designed for stability,
                                performance, and scalability.
                            </p>

                        </div>

                    </div>

                    <div class="service-row">

                        <div class="service-number">03</div>

                        <div class="service-content">

                            <h4>Sales Support System</h4>

                            <p>
                                Empower sales teams with automation tools, customer management,
                                order tracking, and real-time reporting that improve efficiency
                                and accelerate revenue growth.
                            </p>

                        </div>

                    </div>

                    <div class="service-row">

                        <div class="service-number">04</div>

                        <div class="service-content">

                            <h4>Business Platforms & Automation</h4>

                            <p>
                                Develop customized business platforms that centralize operations,
                                automate workflows, and provide organizations with a scalable
                                foundation for long-term digital transformation.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- WHY CHOOSE US --}}
        <section class="why-egead">

            <div class="container">

                <div class="section-heading">

                    <h2>
                        Why Businesses Trust E-GEAD
                    </h2>

                    <p>
                        We combine automation, integration, and operational expertise
                        to help businesses streamline processes, improve efficiency,
                        and build a scalable foundation for sustainable growth.
                    </p>

                </div>

                <div class="row g-4">

                    <div class="col-md-3">

                        <div class="why-card">

                            <i class="bi bi-cpu-fill"></i>

                            <h4>Automation Expertise</h4>

                            <p>
                                Reduce repetitive tasks and operational overhead through
                                intelligent automation designed for modern businesses.
                            </p>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="why-card">

                            <i class="bi bi-diagram-3-fill"></i>

                            <h4>Seamless Integration</h4>

                            <p>
                                Connect marketplaces, websites, fulfillment providers,
                                and internal systems through secure API integrations.
                            </p>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="why-card">

                            <i class="bi bi-graph-up-arrow"></i>

                            <h4>Scalable Solutions</h4>

                            <p>
                                Our platforms are built to support business expansion,
                                increasing transaction volumes, and future growth.
                            </p>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="why-card">

                            <i class="bi bi-shield-check"></i>

                            <h4>Reliable Partnership</h4>

                            <p>
                                We focus on long-term collaboration, providing stable
                                technology solutions and responsive support.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- WHO WE ARE --}}
        <section class="about-company">

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-8">

                        <h2>Who We Are</h2>

                        <div class="about-description">
                            {!! $about_us->description !!}
                        </div>

                    </div>

                    <div class="col-lg-4">

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

                        <div class="about-sidebar-card mt-4">

                            <h3>Connect With Us</h3>

                            <div class="social-list">

                                @if ($about_us->facebook)
                                    <a href="{{ $about_us->facebook }}">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                @endif

                                @if ($about_us->linkedin)
                                    <a href="{{ $about_us->linkedin }}">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                @endif

                                @if ($about_us->youtube)
                                    <a href="{{ $about_us->youtube }}">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                @endif

                                @if ($about_us->tiktok)
                                    <a href="{{ $about_us->tiktok }}">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                @endif

                            </div>

                            <form action=" {{ route('viewer.email.store') }}" method="POST" class="subscribe-form">
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

            </div>

        </section>

        {{-- CORE VALUES --}}
        <section class="company-values">

            <div class="container">

                <div class="section-heading">

                    <h2>
                        Our Core Values
                    </h2>

                </div>

                <div class="values-grid">

                    <div class="value-card">Innovation</div>
                    <div class="value-card">Transparency</div>
                    <div class="value-card">Customer Success</div>
                    <div class="value-card">Continuous Improvement</div>

                </div>

            </div>

        </section>

        {{-- PARTNERS --}}
        <section class="partners-section">

            <div class="container">

                <div class="partners-wrapper">

                    <h2 class="partners-title-h2">

                        Our Partner

                    </h2>

                    <div class="partners-track">

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/google.png') }}" alt="Google ">
                        </div>

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/ebay.png') }}" alt="Ebay">
                        </div>

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/amazon.png') }}" alt="Amazon">
                        </div>

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/esty.png') }}" alt="Esty">
                        </div>

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/seo.png') }}" alt="SEO">
                        </div>

                        <div class="partner-item">
                            <img src="{{ Storage::url('images/tiktok.png') }}" alt="Tiktok">
                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- MAP --}}
        @if ($about_us->google_map)
            <section class="about-map">

                {!! $about_us->google_map !!}

            </section>
        @endif

    </section>

@endsection
