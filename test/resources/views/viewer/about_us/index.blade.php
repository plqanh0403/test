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
                            <strong class="hero-highlight">E-Gead</strong> is a technology and cross-border e-commerce
                            company headquartered in
                            <strong class="hero-highlight">Buon Ma Thuot, Vietnam</strong>. Founded with the vision of
                            empowering businesses through innovation and automation,
                            we deliver high-quality digital solutions that help organizations operate more efficiently and
                            compete successfully in global markets.
                        </p>

                        <p>
                            Our expertise spans
                            <strong class="hero-highlight">Information Technology</strong>,
                            <strong class="hero-highlight">Cross-Border E-Commerce</strong>,
                            <strong class="hero-highlight">Digital Marketing</strong>, and
                            <strong class="hero-highlight">Print-On-Demand Services</strong>.
                            We provide end-to-end solutions including website development, business automation systems,
                            customer service platforms, and API integrations that streamline daily operations.
                        </p>

                        <p>
                            Through our advanced
                            <strong class="hero-highlight">Sales Automation</strong> and
                            <strong class="hero-highlight">Global E-Commerce Ecosystem</strong>,
                            businesses can expand across leading marketplaces such as
                            <strong class="hero-highlight">Amazon</strong>,
                            <strong class="hero-highlight">eBay</strong>,
                            <strong class="hero-highlight">Etsy</strong>,
                            <strong class="hero-highlight">TikTok Shop</strong>, and independent online stores.
                            Our scalable infrastructure enables clients to automate workflows, improve operational
                            efficiency, and accelerate growth.
                        </p>

                        <p>
                            With a growing international presence and partnerships with trusted global brands including
                            <strong class="hero-highlight">Google</strong>,
                            <strong class="hero-highlight">Amazon</strong>,
                            <strong class="hero-highlight">PayPal</strong>,
                            <strong class="hero-highlight">Stripe</strong>, and
                            <strong class="hero-highlight">Airwallex</strong>,
                            E-Gead is committed to delivering innovative technology solutions that help businesses achieve
                            <strong class="hero-highlight">sustainable long-term success</strong>.
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
                        Trusted by Businesses Worldwide
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

        {{-- <div class="company-layout">

            <!-- Company Information -->
            <div class="about-sidebar-card company-info-card">

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

            <!-- Core Values -->
            <div class="about-sidebar-card core-values-card">

                <h3>Our Core Values</h3>

                <div class="values-grid">

                    <div class="value-item">
                        <i class="bi bi-lightning-charge"></i>
                        <div>
                            <span>Automation Excellence</span>
                            <small>Delivering efficient and intelligent workflows.</small>
                        </div>
                    </div>

                    <div class="value-item">
                        <i class="bi bi-diagram-3"></i>
                        <div>
                            <span>Seamless Integration</span>
                            <small>Connecting systems and platforms effortlessly.</small>
                        </div>
                    </div>

                    <div class="value-item">
                        <i class="bi bi-graph-up-arrow"></i>
                        <div>
                            <span>Scalable Solutions</span>
                            <small>Built to support long-term business growth.</small>
                        </div>
                    </div>

                    <div class="value-item">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <span>Reliable Partnership</span>
                            <small>Committed to trust, stability, and success.</small>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="about-sidebar-card connect-card">

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

            <form action="{{ route('viewer.email.store') }}" method="POST" class="subscribe-form">

                @csrf

                <div class="subscribe-box">

                    <input type="email" name="email" placeholder="Enter your email..." required>

                    <input type="hidden" name="source" value="about_us">

                    <button type="submit">
                        <i class="bi bi-send"></i>
                    </button>

                </div>

            </form>

        </div> --}}

        {{-- WHO WE ARE --}}
        {{-- <section class="about-company">

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

        </section> --}}

        {{-- CORE VALUES --}}
        {{-- <section class="company-values">

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

        </section> --}}

        {{-- PARTNERS --}}
        <section class="about-partners-section">

            <div class="container">

                <div class="about-partners-wrapper">

                    <h2 class="about-partners-title-h2">

                        Our Partner

                    </h2>

                    <div class="about-partners-track">

                        <div class="about-partner-item">
                            <img src="{{ Storage::url('images/google.png') }}" alt="Google ">
                        </div>

                        <div class="about-partner-item">
                            <img src="{{ Storage::url('images/ebay.png') }}" alt="Ebay">
                        </div>

                        <div class="about-partner-item">
                            <img src="{{ Storage::url('images/amazon.png') }}" alt="Amazon">
                        </div>

                        <div class="about-partner-item">
                            <img src="{{ Storage::url('images/esty.png') }}" alt="Esty">
                        </div>

                        <div class="about-partner-item">
                            <img src="{{ Storage::url('images/seo.png') }}" alt="SEO">
                        </div>

                        <div class="about-partner-item">
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
