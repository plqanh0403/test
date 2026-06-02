
@extends('viewer.layout')

@section('title', 'Home-EGEAD')

@section('description', 'Explore technology consulting, software development and digital transformation services from EGEAD.')

@section('keywords', 'technology services, software development, digital transformation')

@section('content')
<!-- HERO SECTION -->
    <div class="container">
        <section class="hero-section">

            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active">

                        <img src="{{ asset('images/hero1.jpg') }}"
                            class="hero-image"
                            alt="Technology Solutions">

                        <div class="hero-overlay"></div>

                        <div class="hero-content">

                            <span class="hero-badge">
                                <i class="bi bi-circle-fill"></i>
                                Technology Solutions
                            </span>

                            <h1>
                                Smart Sales Automation
                            </h1>

                            <p>
                                Automate your entire sales process with seamless API integration,
                                smart tracking, and instant fulfillment - saving time, cutting costs,
                                and scaling your business.
                            </p>

                            <div class="hero-buttons">

                                <a href="#"
                                    class="btn-hero-primary">
                                    Contact Us
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#"
                                    class="btn-hero-secondary">
                                    Explore Services
                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">

                        <img src="{{ asset('images/hero2.jpg') }}"
                            class="hero-image"
                            alt="Recruitment">

                        <div class="hero-overlay"></div>

                        <div class="hero-content">

                            <span class="hero-badge">
                                <i class="bi bi-circle-fill"></i>
                                Recruitment Solutions
                            </span>

                            <h1>
                                Hire. Connect.
                                Grow.
                            </h1>

                            <p>
                                Find and connect with the right talent through our recruitment solutions,
                                helping businesses strengthen teams, boost performance,
                                and achieve long-term success.
                            </p>

                            <div class="hero-buttons">

                                <a href="#"
                                    class="btn-hero-primary">
                                    Contact Us
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#"
                                    class="btn-hero-secondary">
                                    Explore Recruitment
                                </a>

                            </div>
                        </div>

                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">

                        <img src="{{ asset('images/hero3.jpg') }}" class="hero-image" alt="Digital Transformation">

                        <div class="hero-overlay"></div>

                        <div class="hero-content">

                            <span class="hero-badge">
                                <i class="bi bi-circle-fill"></i>
                                Technology Solutions

                            </span>

                            <h1>
                                All-in-One Platform
                            </h1>

                            <p>
                                Build and manage powerful websites with reliable hosting and centralized tools
                                designed to keep your business connected, efficient,
                                and ready to grow sustainably.
                            </p>

                            <div class="hero-buttons">

                                <a href="#"
                                    class="btn-hero-primary">
                                    Contact Us
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                <a href="#"
                                    class="btn-hero-secondary">
                                    Explore Technology Solutions
                                </a>

                            </div>
                        </div>

                    </div>

                </div>

                <!-- Arrows -->

                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">

                    <span class="hero-arrow">
                        <i class="bi bi-arrow-left"></i>
                    </span>

                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">

                    <span class="hero-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </button>

                <!-- Dots -->

                <div class="carousel-indicators">

                    <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="0"
                        class="active"></button>

                    <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="1"></button>

                    <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="2"></button>

                </div>

            </div>

        </section>

        <section class="services-section">

            <div class="container">

                <div class="section-heading">

                    <span class="section-badge">Our Services</span>

                    <h2>
                        Technology Solutions
                        Tailored For Your Business
                    </h2>

                    <p>
                        We provide end-to-end technology services
                        helping businesses innovate, scale and succeed.
                    </p>

                </div>

                <div class="swiper serviceSwiper">

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="service-card">

                                <div class="service-icon">
                                    <i class="bi bi-code-slash"></i>
                                </div>

                                <h3>Web Development</h3>

                                <p>
                                    Custom websites and enterprise systems
                                    built with modern technologies.
                                </p>

                                <a href="#">
                                    Learn More
                                </a>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="service-card">

                                <div class="service-icon">
                                    <i class="bi bi-phone"></i>
                                </div>

                                <h3>Mobile Apps</h3>

                                <p>
                                    Native and cross-platform mobile
                                    applications for businesses.
                                </p>

                                <a href="#">
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="service-card">

                                <div class="service-icon">
                                    <i class="bi bi-cloud"></i>
                                </div>

                                <h3>Cloud Solutions</h3>

                                <p>
                                    Secure cloud infrastructure
                                    and scalable deployment solutions.
                                </p>

                                <a href="#">
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="service-card">

                                <div class="service-icon">
                                    <i class="bi bi-people"></i>
                                </div>

                                <h3>IT Recruitment</h3>

                                <p>
                                    Connecting top technology talent
                                    with growing businesses.
                                </p>

                                <a href="#">
                                    Learn More
                                </a>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="service-card">

                                <div class="service-icon">
                                    <i class="bi bi-cpu"></i>
                                </div>

                                <h3>AI Solutions</h3>

                                <p>
                                    AI-powered automation and intelligent
                                    business processes.
                                </p>

                                <a href="#">
                                    Learn More
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </section>

        <section class="why-section">

            <div class="container">

                <div class="row align-items-center">

                    <!-- LEFT -->
                    <div class="col-lg-6">

                        <span class="section-badge">
                            Why Choose Us
                        </span>

                        <h2 class="why-title">
                            We Build Scalable
                            Digital Solutions
                        </h2>

                        <p class="why-desc">
                            At EGEAD, we combine technology expertise with business insight
                            to deliver solutions that drive growth and innovation.
                        </p>

                        <a href="#" class="why-btn">
                            Learn More
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-6">

                        <div class="why-list">

                            <div class="why-item">
                                <i class="bi bi-lightning-charge"></i>
                                <div>
                                    <h4>Fast Delivery</h4>
                                    <p>Quick turnaround with high quality output</p>
                                </div>
                            </div>

                            <div class="why-item">
                                <i class="bi bi-shield-check"></i>
                                <div>
                                    <h4>Secure Systems</h4>
                                    <p>Enterprise-grade security and reliability</p>
                                </div>
                            </div>

                            <div class="why-item">
                                <i class="bi bi-bar-chart"></i>
                                <div>
                                    <h4>Business Growth</h4>
                                    <p>Solutions designed to scale your business</p>
                                </div>
                            </div>

                            <div class="why-item">
                                <i class="bi bi-people"></i>
                                <div>
                                    <h4>Expert Team</h4>
                                    <p>Experienced engineers and consultants</p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="portfolio-section">

            <div class="container">

                <div class="section-heading text-center">

                    <span class="section-badge">Our Work</span>

                    <h2>
                        Featured Projects
                    </h2>

                    <p>
                        Explore some of our recent projects and success stories
                    </p>

                </div>

                <div class="swiper portfolioSwiper">

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <a href="#" class="portfolio-card">
                                <img src="{{ asset('images/hero1.jpg') }}">
                                <div class="portfolio-overlay">
                                    <span class="portfolio-tag">E-commerce</span>
                                    <h4>E-commerce Platform</h4>
                                </div>
                            </a>
                        </div>

                        <div class="swiper-slide">
                            <a href="#" class="portfolio-card">
                                <img src="{{ asset('images/hero2.jpg') }}">
                                <div class="portfolio-overlay">
                                    <span class="portfolio-tag">Mobile</span>
                                    <h4>Banking App</h4>
                                </div>
                            </a>
                        </div>

                        <div class="swiper-slide">
                            <a href="#" class="portfolio-card">
                                <img src="{{ asset('images/hero3.jpg') }}">
                                <div class="portfolio-overlay">
                                    <span class="portfolio-tag">AI</span>
                                    <h4>AI Dashboard</h4>
                                </div>
                            </a>
                        </div>

                    </div>

                    <!-- arrows -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

                <div class="text-center mt-5">
                    <a href="#" class="portfolio-btn">
                        View All Projects
                    </a>
                </div> 

            </div>

        </section>
    </div>
@endsection
