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
    <link rel="icon" href="{{ Storage::url($about_us->favicon) }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- App CSS & JS --}}
    <link rel="stylesheet" href="{{ asset('viewer.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>

    {{-- HEADER --}}
    <header class="page-header shadow-sm">

        <nav class="navbar navbar-expand-lg">

            <div class="container">

                {{-- Logo --}}
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <img src="{{ Storage::url($about_us->light_logo) }}" alt="EGEAD Logo">
                </a>

                <div id="mainNavbar" class="navbar-content"> {{-- class="collapse navbar-collapse" --- IGNORE --- --}}

                    <ul class="navbar-nav nav-menu">

                        <li class="nav-item dropdown-custom">
                            <a class="nav-link {{ request()->routeIs('viewer.services.*') ? 'active' : '' }}">
                                Services <i class="bi bi-chevron-down"></i>
                            </a>

                            <div class="dropdown-menu-custom">
                                @foreach ($serviceCategories as $serviceCategory)
                                    <a href="{{ route('viewer.services.index', $serviceCategory->slug) }}">
                                        <i class="bi bi-grid"></i>
                                        {{ $serviceCategory->name }}
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewer.recruitments.index') }}"
                                class="nav-link {{ request()->routeIs('viewer.recruitments.*') ? 'active' : '' }}">
                                Recruitment
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewer.about_us') }}"
                                class="nav-link {{ request()->routeIs('viewer.about_us') ? 'active' : '' }}">
                                About Us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewer.blogs.index') }}"
                                class="nav-link {{ request()->routeIs('viewer.blogs.*') ? 'active' : '' }}">
                                Blogs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('viewer.contact') }}"
                                class="nav-link {{ request()->routeIs('viewer.contact') ? 'active' : '' }}">Contact
                                Us</a>
                        </li>
                    </ul>

                </div>

                <div class="nav-action">
                    <a href="{{ route('viewer.contact') }}" class="consultation-btn">
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
                    <a href="{{ route('viewer.contact') }}" class="cta-btn"> {{-- {{ route('contact') }} --}}
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
                        <img src="{{ Storage::url($about_us->light_logo) }}" alt="EGEAD Logo">
                    </a>



                    <div class="footer-action">
                        <a href="{{ route('viewer.contact') }}" class="consultation-btn"> {{-- {{ route('contact') }} --}}
                            Get Free Consultation
                        </a>
                    </div>

                    <div class="footer-social">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>

                </div>

                <!-- Services -->
                <div class="footer-col">

                    <h4>Services</h4>

                    <ul>
                        @foreach ($serviceCategories as $category)
                            <li>
                                <a
                                    href="{{ route('viewer.services.index', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <!-- SUBSCRIBE -->
                <div class="footer-col footer-subscribe">

                    <h4>Subscribe to our newsletter</h4>

                    <p>
                        Get latest updates, job opportunities and tech insights from EGEAD.
                    </p>

                    <form action=" {{ route('viewer.email.store') }}" method="POST" class="subscribe-form">
                        @csrf

                        <div class="subscribe-box">

                            <input type="email" name="email" placeholder="Enter your email..." required>

                            <input type="hidden" name="source" value="footer">

                            <button type="submit">
                                <i class="bi bi-send"></i>
                            </button>

                        </div>

                    </form>

                </div>

                <!-- Contact -->
                <div class="footer-col">

                    <h4>Contact</h4>

                    <ul class="footer-contact">
                        <li>
                            <i class="bi bi-envelope"></i>
                            {{ $about_us->email }}
                        </li>

                        <li>
                            <i class="bi bi-telephone"></i>
                            {{ $about_us->phone }}
                        </li>

                        <li>
                            <i class="bi bi-geo-alt"></i>
                            {{ $about_us->address }}
                        </li>
                    </ul>

                </div>

            </div>

            <div class="footer-bottom">
                <p>
                    © {{ date('Y') }} E-GEAD.
                </p>
            </div>
        </div>

    </footer>

    <div class="position-fixed top-0 end-0 p-4" style="z-index:9999;">

        @if (session('success'))
            <div class="custom-alert success-alert auto-hide-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="custom-alert error-alert auto-hide-alert">
                <i class="bi bi-x-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @stack('scripts')

    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.auto-hide-alert');

            alerts.forEach(alert => {
                alert.style.transition = '0.5s';
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(100%)';

                setTimeout(() => {
                    alert.remove();
                }, 500);
            });
        }, 3000);
    </script>

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
                            0: {
                                slidesPerView: 1
                            },
                            768: {
                                slidesPerView: 2
                            },
                            1200: {
                                slidesPerView: 3
                            }
                        }

                    });

                }

            });
        }, {
            threshold: 0.3 // xuất hiện 30% thì chạy
        });

        if (portfolioSection) {
            portfolioObserver.observe(portfolioSection);
        }

        /* TESTIMONIAL SWIPER */
        new Swiper(".testimonialSwiper", {
            direction: "vertical",
            slidesPerView: 3,
            centeredSlides: true,
            loop: true,
            speed: 1000,
            spaceBetween: 0,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        /* PROCESS */
        const steps = document.querySelectorAll('.process-step');

        window.addEventListener('scroll', () => {
            steps.forEach((step, index) => {

                const rect = step.getBoundingClientRect();

                if (rect.top < window.innerHeight - 100) {

                    // hiệu ứng fade-in cũ
                    step.classList.add('show');

                    // 🔥 thêm animation vòng tròn (chạy 1 lần)
                    if (!step.classList.contains('animate')) {
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
        const trustSection = document.querySelector('.trust-section');

        if (trustSection) {

            const counters = document.querySelectorAll('.trust-item h3');

            const runCounter = (el) => {
                const target = el.innerText.replace('+', '').replace('/7', '');
                let count = 0;

                const update = () => {
                    count += Math.ceil(target / 50);

                    if (count < target) {
                        el.innerText = count + (el.dataset.original.includes('+') ? '+' : '');
                        requestAnimationFrame(update);
                    } else {
                        el.innerText = el.dataset.original;
                    }
                };

                update();
            };

            const trustObserver = new IntersectionObserver(entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        counters.forEach(el => {
                            el.dataset.original = el.innerText;
                            runCounter(el);
                        });

                        trustObserver.disconnect();
                    }

                });

            });

            trustObserver.observe(trustSection);
        }
    </script>

    <script>
        document.getElementById('career-search-form').addEventListener('submit', function () {
            this.action = "{{ route('viewer.recruitments.index') }}#job-list";
        });
    </script>

    <script>
        const items = document.querySelectorAll('.why-item');

        window.addEventListener('scroll', () => {
            items.forEach(item => {
                const rect = item.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    item.classList.add('show');
                }
            });
        });
    </script>
</body>

</html>
