<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        @yield('title', 'EGEAD - Technology Solutions')
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO --}}
    <meta name="description" content="@yield('description', 'EGEAD provides technology services, recruitment solutions and digital transformation consulting.')">

    <meta name="keywords" content="@yield('keywords', 'EGEAD, technology, recruitment, software development')">

    <meta name="author" content="EGEAD">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'EGEAD')">
    <meta property="og:description" content="@yield('description', 'Technology solutions by EGEAD')">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/favicon.png') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    {{-- App CSS & JS --}}
    <link rel="stylesheet" href="{{ asset('viewer.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css','resources/js/app.js'])

    @stack('styles')
</head>

<body>

    {{-- HEADER --}}
    <header class="page-header shadow-sm">

        <nav class="navbar navbar-expand-lg">

            <div class="container">

                {{-- Logo --}}
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="EGEAD Logo">
                </a>

                <div id="mainNavbar" class="navbar-content"> {{--class="collapse navbar-collapse" --- IGNORE -----}}

                    <ul class="navbar-nav nav-menu">

                        <li class="nav-item dropdown-custom">
                            <a href="#" class="nav-link">
                                Services <i class="bi bi-chevron-down"></i>
                            </a>

                            <div class="dropdown-menu-custom">
                                @foreach($serviceCategories as $serviceCategory)
                                    <a href="{{ route('viewer.services.index', $serviceCategory->slug) }}">
                                        <i class="bi bi-grid"></i>
                                        {{ $serviceCategory->name}}
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewer.recruitments.index')}}" class="nav-link">
                                Recruitment
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                About Us
                                <i class="bi bi-chevron-down"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>

                </div>

                <div class="nav-action">
                    <a href="#" class="consultation-btn"> {{--{{ route('contact') }}--}}
                        Get Free Consultation
                    </a>
                </div>

                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNavbar">

                    <span class="navbar-toggler-icon"></span>

                </button>

            </div>

        </nav>

    </header>

    {{-- PAGE CONTENT --}}
    <main class="page-content">
        @yield('content')
    </main>

    {{-- QUOTE --}}
    <section class="cta-section">
        <div class="container">
            <div class="cta-box">

                <div class="cta-content">
                    <span class="cta-badge">
                        EGEAD Technology Solutions
                    </span>

                    <h2>
                        Ready to Transform Your Business?
                    </h2>

                    <p>
                        We help businesses build scalable software solutions,
                        optimize operations, and accelerate digital transformation.
                    </p>
                </div>

                <div class="cta-action">
                    <a href="#" class="cta-btn"> {{--{{ route('contact') }}--}}
                        Get Free Consultation
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="site-footer">

        <div class="container">
            <div class="footer-container">

            <!-- Company -->
            <div class="footer-col footer-brand">

                <a href="#" class="footer-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="EGEAD Logo">
                </a>

                <p class="footer-description mb-4">
                    EGEAD provides innovative technology solutions,
                    recruitment services and digital transformation
                    consulting for businesses.
                </p>

                <div class="footer-action">
                    <a href="#" class="consultation-btn"> {{--{{ route('contact') }}--}}
                        Get Free Consultation
                    </a>
                </div>

                <div class="footer-social">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>

            </div>

            <!-- Quick Links -->
            <div class="footer-col">

                <h4>Quick Links</h4>

                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li> {{--{{ route('home') }}--}}
                    <li><a href="#">About Us</a></li> {{--{{ route('about') }}--}}
                    <li><a href="#">Services</a></li> {{--{{ route('services') }}--}}
                    <li><a href="#">Recruitment</a></li> {{--{{ route('recruitments') }}--}}
                    <li><a href="#">Contact</a></li> {{--{{ route('contact') }}--}}
                </ul>

            </div>

            <!-- Services -->
            <div class="footer-col">

                <h4>Services</h4>

                <ul>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Mobile Development</a></li>
                    <li><a href="#">Cloud Solutions</a></li>
                    <li><a href="#">IT Consulting</a></li>
                </ul>

            </div>

            <!-- Contact -->
            <div class="footer-col">

                <h4>Contact</h4>

                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-envelope"></i>
                        info@egead.com
                    </li>

                    <li>
                        <i class="bi bi-telephone"></i>
                        +84 xxx xxx xxx
                    </li>

                    <li>
                        <i class="bi bi-geo-alt"></i>
                        Buon Ma Thuot City, Vietnam
                    </li>
                </ul>

            </div>

            <!-- SUBSCRIBE -->
        <div class="footer-subscribe">

            <h4>Subscribe to our newsletter</h4>

            <p>
                Get latest updates, job opportunities and tech insights from EGEAD.
            </p>

            <form action="#" method="POST" class="subscribe-form">
                @csrf

                <div class="subscribe-box">

                    <input type="email"
                        name="email"
                        placeholder="Enter your email..."
                        required>

                    <button type="submit">
                        <i class="bi bi-send"></i>
                    </button>

                </div>

            </form>

        </div>

        </div>

        <div class="footer-bottom">
            <p>
                © {{ date('Y') }} EGEAD. All Rights Reserved.
            </p>
        </div>
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')

    <script>
        /* SERVICE SWIPER */
        new Swiper(".serviceSwiper", {

            loop: true,

            centeredSlides: true,

            slidesPerView: 3,

            spaceBetween: 30,

            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },

            navigation: {
                nextEl: ".service-next",
                prevEl: ".service-prev",
            },

            breakpoints: {

                0: {
                    slidesPerView: 1,
                },

                768: {
                    slidesPerView: 2,
                },

                1200: {
                    slidesPerView: 3,
                }
            }
        });

        /* PORTFOLIO SWIPER */
        let portfolioSwiper = null;

        const portfolioSection = document.querySelector('.portfolio-section');

        const portfolioObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {

                if (entry.isIntersecting && !portfolioSwiper) {

                    portfolioSwiper = new Swiper('.portfolioSwiper', {

                        slidesPerView: 3,
                        spaceBetween: 25,
                        loop: true,

                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },

                        navigation: {
                            nextEl: '.portfolio-next',
                            prevEl: '.portfolio-prev',
                        },

                        breakpoints: {
                            0: { slidesPerView: 1 },
                            768: { slidesPerView: 2 },
                            1200: { slidesPerView: 3 }
                        }

                    });

                }

            });
        }, {
            threshold: 0.3 // xuất hiện 30% thì chạy
        });

        portfolioObserver.observe(portfolioSection);

        /* TESTIMONIAL SWIPER */
        new Swiper('.testimonialSwiper', {
            direction: 'vertical',

            slidesPerView: 'auto',   // 👈 QUAN TRỌNG
            centeredSlides: true,

            loop: true,
            loopedSlides: 4,
            loopAdditionalSlides: 2,

            spaceBetween: 20,
            speed: 800,

            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });

        /* PROCESS */
        const steps = document.querySelectorAll('.process-step');

        window.addEventListener('scroll', () => {
            steps.forEach((step, index) => {

                const rect = step.getBoundingClientRect();

                if(rect.top < window.innerHeight - 100){

                    // hiệu ứng fade-in cũ
                    step.classList.add('show');

                    // 🔥 thêm animation vòng tròn (chạy 1 lần)
                    if(!step.classList.contains('animate')){
                        setTimeout(() => {
                            step.classList.add('animate');

                            setTimeout(() => {
                                step.classList.remove('animate');
                            }, 1200);
                        }, index * 200); // delay cho đẹp
                    }

                }

            });
        });

        /* TRUST COUNTER */
        const counters = document.querySelectorAll('.trust-item h3');

        const runCounter = (el) => {
            const target = el.innerText.replace('+','').replace('/7','');
            let count = 0;

            const update = () => {
                count += Math.ceil(target / 50);
                if(count < target){
                    el.innerText = count + (el.innerText.includes('+') ? '+' : '');
                    requestAnimationFrame(update);
                }else{
                    el.innerText = el.dataset.original;
                }
            };

            update();
        };

        const trustObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    counters.forEach(el => {
                        el.dataset.original = el.innerText;
                        runCounter(el);
                    });
                    trustObserver.disconnect();
                }
            });
        });

        trustObserver.observe(document.querySelector('.trust-section'));
    </script>

    <script>
        const items = document.querySelectorAll('.why-item');

        window.addEventListener('scroll', () => {
            items.forEach(item => {
                const rect = item.getBoundingClientRect();
                if(rect.top < window.innerHeight - 100){
                    item.classList.add('show');
                }
            });
        });
    </script>
</body>

</html>
