<!DOCTYPE html>
<html>

<head>
    <title>EGEAD CMS Admin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('admin1.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="admin-wrapper">

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">

            <div class="logo">
                <x-application-logo class="logo-img" />
            </div>

            <nav class="sidebar-menu">

                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.users') }}"
                    class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.blogs') }}"
                    class="menu-item {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Blogs</span>
                </a>

                <a href="{{ route('admin.services') }}"
                    class="menu-item {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i>
                    <span>Services</span>
                </a>

                <a href="{{ route('admin.recruitments') }}"
                    class="menu-item {{ request()->routeIs('admin.recruitments') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace"></i>
                    <span>Recruitments</span>
                </a>

                <a href="{{ route('admin.submit_emails') }}"
                    class="menu-item {{ request()->routeIs('admin.submit_emails') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Submit Email</span>
                </a>

                <a href="{{ route('admin.submit_contacts') }}"
                    class="menu-item {{ request()->routeIs('admin.submit_contacts') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text"></i>
                    <span>Submit Contact</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="menu-item logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>

            </nav>

        </aside>

        <!-- Main -->
        <main class="main-content">

            <!-- Topbar -->
            <header class="topbar">

                <div class="topbar-left">

                    <button class="menu-toggle" id="menuToggle">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="search-box">
                        <i class="bi bi-search"></i>

                        <input type="text" placeholder="Search">
                    </div>

                </div>

                <div class="topbar-right">

                    <div class="notification">
                        <i class="bi bi-bell"></i>
                    </div>

                    <div class="user-profile">

                        <div class="avatar">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>

                        <div>

                            <div class="user-name">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="user-role">
                                {{ ucfirst(Auth::user()->role) }}
                            </div>

                        </div>

                    </div>

                </div>

            </header>

            <!-- Page Content -->
            <div class="page-content">
                @yield('content')
            </div>

        </main>

    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="position-fixed top-0 end-0 p-4" style="z-index:9999;">

        @if(session('success'))
        <div class="custom-alert success-alert auto-hide-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="custom-alert error-alert auto-hide-alert">
            <i class="bi bi-x-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif
    </div>

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
    document.querySelectorAll('.mark-seen-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;

            markAsSeen(id);
        });
    });

    function markAsSeen(submitContact) {
        console.log(submitContact);

        fetch(`/admin/submit-contacts/${submitContact}/seen`, {
            method: 'PUT',

            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
    }
    </script>

    <script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const menuToggle = document.getElementById('menuToggle');
    const overlay = document.getElementById('sidebarOverlay');

    menuToggle.addEventListener('click', () => {

        if (window.innerWidth <= 768) {

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');

        } else {

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

        }

    });

    overlay.addEventListener('click', () => {

        sidebar.classList.remove('show');
        overlay.classList.remove('show');

    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>