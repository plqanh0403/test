@extends('viewer.layout')

@section('title', 'E-GEAD Company')

@section('description', 'Explore technology consulting, software development and digital transformation services from EGEAD.')

@section('keywords', 'technology services, software development, digital transformation')

@section('content')

<div class="container">

    <!-- HERO SECTION -->
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

                            <a href="{{ route('viewer.contact') }}"
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

                            <a href="{{ route('viewer.contact') }}"
                                class="btn-hero-primary">
                                Contact Us
                                <i class="bi bi-arrow-right"></i>
                            </a>

                            <a href="{{ route('viewer.recruitments.index') }}"
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

                            <a href="{{ route('viewer.contact') }}"
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

    <section class="trust-section">
        <div class="container">

            <div class="row text-center">

                <div class="col-md-3 col-6">
                    <div class="trust-item">
                        <h3>100+</h3>
                        <p>Clients Worldwide</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="trust-item">
                        <h3>50+</h3>
                        <p>Projects Delivered</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="trust-item">
                        <h3>5+</h3>
                        <p>Years Experience</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="trust-item">
                        <h3>24/7</h3>
                        <p>Support</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="services-section">

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

            <div class="swiper-button-prev service-prev"></div>
            <div class="swiper-button-next service-next"></div>
        </div>
    </section>

    <section class="why-section">

        <div class="row align-items-center">

            <!-- LEFT -->
            <div class="col-lg-6 mb-4">

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

    </section>

    <section class="process-cta">
        <div class="container">

            <div class="process-cta-box">

                <div class="process-cta-content">
                    <h3>
                        Let's Build Something Great Together
                    </h3>
                </div>

                <div class="process-cta-actions">

                    <a href="{{ route('viewer.contact') }}"
                        class="process-cta-btn primary">
                        Get Free Consultation
                    </a>

                    <a href="#"
                        class="process-cta-btn secondary">
                        Explore Services
                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="process-section">
        <div class="container">

            <div class="section-heading">
                <span class="section-badge">Our Process</span>
                <h2>How We Work</h2>
                <p>We follow a proven process to deliver high-quality solutions</p>
            </div>

            <div class="process-wrapper">

                <div class="process-step">
                    <div class="process-icon">1</div>
                    <h4>Discovery</h4>
                    <p>We understand your business needs and goals.</p>
                </div>

                <div class="process-step">
                    <div class="process-icon">2</div>
                    <h4>Planning</h4>
                    <p>We create a clear roadmap and strategy.</p>
                </div>

                <div class="process-step">
                    <div class="process-icon">3</div>
                    <h4>Development</h4>
                    <p>We build scalable and high-performance solutions.</p>
                </div>

                <div class="process-step">
                    <div class="process-icon">4</div>
                    <h4>Delivery</h4>
                    <p>We deploy and support your product.</p>
                </div>

            </div>

        </div>
    </section>

    <section class="portfolio-section">

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

                <div class="swiper-slide">
                    <a href="#" class="portfolio-card">
                        <img src="{{ asset('images/hero3.jpg') }}">
                        <div class="portfolio-overlay">
                            <span class="portfolio-tag">Four</span>
                            <h4>Cái số 4</h4>
                        </div>
                    </a>
                </div>

            </div>

            <!-- arrows -->
            <div class="swiper-button-prev portfolio-prev"></div>
            <div class="swiper-button-next portfolio-next"></div>

        </div>

        <div class="text-center mt-2">
            <a href="#" class="portfolio-btn">
                View More
            </a>
        </div>

    </section>

    <section class="testimonial-section">
        <div class="row align-items-center">

            <!-- LEFT -->
            <div class="col-lg-5 testimonial-content">

                <span class="section-badge">Testimonials</span>

                <h2>
                    Trusted by Our Clients Worldwide
                </h2>

                <p>
                    We deliver scalable solutions and real business value
                    that help companies grow faster and smarter.
                </p>

                <a href="#" class="testimonial-btn">
                    View More Reviews
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-7">
                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/billgates.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Bill Gates</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/mark.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Mark Zuckerberg</h4>
                                        <span>CEO, Meta</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/trump.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Donald Trump</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="https://i.pravatar.cc/100?img=1" class="avatar">

                                    <div class="info">
                                        <h4>Nguyễn Văn A</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/billgates.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Bill Gates</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/mark.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Mark Zuckerberg</h4>
                                        <span>CEO, Meta</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="{{ asset('images/trump.jpg') }}" class="avatar">

                                    <div class="info">
                                        <h4>Donald Trump</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card">

                                <div class="testimonial-top">
                                    <img src="https://i.pravatar.cc/100?img=1" class="avatar">

                                    <div class="info">
                                        <h4>Nguyễn Văn A</h4>
                                        <span>CEO, ABC Company</span>

                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                <p class="testimonial-text">
                                    <i class="bi bi-quote"></i>
                                    “EGEAD giúp chúng tôi tăng trưởng nhanh chóng với hệ thống cực kỳ ổn định.”
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="blog-section">

        <!-- HEADING -->
        <div class="section-heading text-center">
            <span class="section-badge">Insights</span>

            <h2>
                Latest Articles & Insights
            </h2>

            <p>
                Stay updated with technology trends, business strategies and expert knowledge from EGEAD.
            </p>
        </div>

        <!-- BLOG GRID -->
        <div class="row g-4">

            <!-- ITEM -->
            <div class="col-lg-4 col-md-6">
                <a href="#" class="blog-card">

                    <div class="blog-image">
                        <img src="{{ asset('images/hero1.jpg') }}" alt="AI Trends 2025">
                        <span class="blog-tag">Technology</span>
                    </div>

                    <div class="blog-content">

                        <div class="blog-meta">
                            <span><i class="bi bi-calendar"></i> May 2026</span>
                            <span><i class="bi bi-clock"></i> 5 min read</span>
                        </div>

                        <h3>
                            Top AI Trends That Will Shape 2026
                        </h3>

                        <p>
                            Discover how artificial intelligence is transforming industries and what businesses should prepare for.
                        </p>

                        <span class="blog-read-more">
                            Read More <i class="bi bi-arrow-right"></i>
                        </span>

                    </div>
                </a>
            </div>

            <!-- COPY thêm 2-3 card nữa -->
            <div class="col-lg-4 col-md-6">
                <a href="#" class="blog-card">

                    <div class="blog-image">
                        <img src="{{ asset('images/hero2.jpg') }}">
                        <span class="blog-tag">Business</span>
                    </div>

                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="bi bi-calendar"></i> May 2026</span>
                            <span><i class="bi bi-clock"></i> 6 min</span>
                        </div>

                        <h3>How Digital Transformation Boosts Growth</h3>

                        <p>Practical strategies for companies to scale using modern technologies.</p>

                        <span class="blog-read-more">
                            Read More <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6">
                <a href="#" class="blog-card">

                    <div class="blog-image">
                        <img src="{{ asset('images/hero3.jpg') }}">
                        <span class="blog-tag">Recruitment</span>
                    </div>

                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="bi bi-calendar"></i> May 2026</span>
                            <span><i class="bi bi-clock"></i> 4 min</span>
                        </div>

                        <h3>Hiring Tech Talent in 2026</h3>

                        <p>What companies need to know to attract and retain top developers.</p>

                        <span class="blog-read-more">
                            Read More <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </a>
            </div>

        </div>

        <!-- CTA -->
        <div class="text-center mt-5">
            <a href="{{ route('viewer.blogs.index') }}" class="blog-btn">
                View All Articles
            </a>
        </div>

    </section>
</div>
@endsection
