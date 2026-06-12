@extends('viewer.layout')

@section('title', 'E-GEAD Company')

@section('description', 'Explore technology consulting, software development and digital transformation services from EGEAD.')

@section('keywords', 'technology services, software development, digital transformation')

@section('content')

<div class="container">

    <!-- HERO SECTION -->
    <section class="hero-section">

        <div class="hero-wrapper">

            <!-- LEFT -->
            <div class="hero-content">

                <span class="hero-badge">

                    <span class="hero-badge-dot"></span>

                    E-GEAD - POD Commerce & Sales Automation

                </span>

                <h1>
                    Scale Your Business With
                    <span class="hero-highlight">
                        Smart Automation
                    </span>
                </h1>

                <p>
                    <strong class="hero-highlight">E-GEAD</strong>
                    specializes in
                    <span class="hero-highlight">Sales Automation</span>
                    and
                    <span class="hero-highlight">Print-On-Demand Solutions</span>
                    that help businesses automate operations, optimize workflows, and scale across
                    <span class="hero-highlight">Global Marketplaces</span>.

                    Through
                    <span class="hero-highlight">Intelligent Technology</span>,
                    seamless integrations, and efficient fulfillment processes, we enable organizations to
                    <span class="hero-highlight">Reduce Costs</span>,
                    <span class="hero-highlight">Increase Productivity</span>,
                    and deliver exceptional customer experiences.

                    Our mission is to empower businesses with
                    <span class="hero-highlight">Innovative Digital Solutions</span>
                    that drive
                    <span class="hero-highlight">Sustainable Growth</span>
                    and long-term success in the modern marketplace.
                </p>

                <div class="hero-features">

                    <div class="hero-feature">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Automated Sales Workflow
                    </div>

                    <div class="hero-feature">
                        <i class="bi bi-shop"></i>
                        POD Marketplace Integration
                    </div>

                    <div class="hero-feature">
                        <i class="bi bi-graph-up-arrow"></i>
                        Business Growth Solutions
                    </div>

                </div>

                <div class="hero-buttons">

                    <a href="{{ route('viewer.contact') }}"
                        class="btn-hero-primary">

                        Contact Us

                        <i class="bi bi-arrow-right"></i>

                    </a>

                    <a href="#"
                        class="btn-hero-secondary"> {{--{{ route('viewer.services') }}--}}

                        Explore Services

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="hero-gallery">

                <div class="hero-gallery-main">

                    <img src="{{ Storage::url('images/automation.jpg') }}" alt="Automation E-Gead">

                </div>

                <div class="hero-gallery-grid">

                    <img src="{{ Storage::url('images/pod3.jpg') }}" alt="POD E-Gead">

                    <img src="{{ Storage::url('images/pod2.jpg') }}" alt="POD E-Gead">

                </div>

            </div>

        </div>

    </section>

    <section class="partners-section">

        <div class="container">

            <div class="partners-wrapper">

                <div class="partners-title">

                    Driving Loyalty. Chosen by Industry-Leading Brands.

                </div>

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

    {{-- <section class="services-section">

        <div class="section-heading">

            <span class="section-badge">Our Services</span>

            <h1>
                Technology Solutions
                Tailored For Your Business
            </h1>

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
    </section> --}}

    <section class="why-section">

        <div class="row align-items-center">

            <!-- LEFT -->
            <div class="col-lg-6 mb-4">

                <span class="section-badge">
                    Why Choose Us
                </span>

                <h1 class="why-title">
                    We Build Scalable
                    Digital Solutions
                </h1>

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

    <section class="process-cta">
        <div class="container">

            <div class="process-cta-box">

                <div class="process-cta-content">
                    <h1>
                        Let's Build Something Great Together
                    </h1>
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
                <h1>How We Work</h1>
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

    {{-- <section class="portfolio-section">

        <div class="section-heading text-center">

            <h1>
                Featured Projects
            </h1>

            <p>
                Explore some of our recent projects and success stories
            </p>

        </div>

        <div class="swiper portfolioSwiper">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <a href="#" class="portfolio-card">
                        <img src="{{ Storage::url('images/hero1.jpg') }}">
                        <div class="portfolio-overlay">
                            <span class="portfolio-tag">E-commerce</span>
                            <h4>E-commerce Platform</h4>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="#" class="portfolio-card">
                        <img src="{{ Storage::url('images/hero2.jpg') }}">
                        <div class="portfolio-overlay">
                            <span class="portfolio-tag">Mobile</span>
                            <h4>Banking App</h4>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="#" class="portfolio-card">
                        <img src="{{ Storage::url('images/hero3.jpg') }}">
                        <div class="portfolio-overlay">
                            <span class="portfolio-tag">AI</span>
                            <h4>AI Dashboard</h4>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="#" class="portfolio-card">
                        <img src="{{ Storage::url('images/hero3.jpg') }}">
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

    </section> --}}

    <section class="testimonial-section">
        <div class="row align-items-center">

            <!-- LEFT -->
            <div class="col-lg-5 testimonial-content">

                <span class="section-badge">Testimonials</span>

                <h1>
                    Trusted by Our Clients Worldwide
                </h1>

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
                                    <img src="{{ Storage::url('images/billgates.jpg') }}" class="avatar">

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
                                    <img src="{{ Storage::url('images/mark.jpg') }}" class="avatar">

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
                                    <img src="{{ Storage::url('images/trump.jpg') }}" class="avatar">

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
                                    <img src="{{ Storage::url('images/billgates.jpg') }}" class="avatar">

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
                                    <img src="{{ Storage::url('images/mark.jpg') }}" class="avatar">

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
                                    <img src="{{ Storage::url('images/trump.jpg') }}" class="avatar">

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
            <h1>
                Latest Articles & Insights
            </h1>

            <p>
                Stay updated with technology trends, business strategies and expert knowledge from EGEAD.
            </p>
        </div>

        <!-- BLOG GRID -->
        <div class="row g-4">

            @foreach($latest_blogs as $blog)

                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('viewer.blogs.show', $blog->slug) }}" class="blog-card">

                        <div class="blog-image">
                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->thumbnail_alt }}">
                            <span class="blog-tag">{{ $blog->category->name }}</span>
                        </div>

                        <div class="blog-content">

                            <div class="blog-meta">
                                <span><i class="bi bi-calendar"></i>{{ date('d M Y', strtotime($blog->published_at)) }}</span>
                                <span><i class="bi bi-clock"></i> 5 min read</span>
                            </div>

                            <h4>
                                {{ $blog->title }}
                            </h4>

                            <p>
                                {{ $blog->excerpt }}
                            </p>

                            <span class="blog-read-more">
                                Read More <i class="bi bi-arrow-right"></i>
                            </span>

                        </div>
                    </a>

                </div>

            @endforeach

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
