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
        <aside class="sidebar">

            <div class="logo">
                <x-application-logo class="logo-img" />
            </div>

            <nav class="sidebar-menu">

                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.users') }}"
                    class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Users
                </a>

                <a href="{{ route('admin.blogs') }}" class="menu-item">
                    <i class="bi bi-journal-text"></i>
                    Blogs
                </a>

                <a href="{{ route('admin.services') }}" class="menu-item">
                    <i class="bi bi-briefcase"></i>
                    Services
                </a>

                <a href="{{ route('admin.recruitments') }}" class="menu-item">
                    <i class="bi bi-person-workspace"></i>
                    Recruitments
                </a>

                <a href="{{ route('admin.submit_emails') }}" class="menu-item">
                    <i class="bi bi-envelope"></i>
                    Submit Email
                </a>

                <a href="{{ route('admin.submit_contacts') }}" class="menu-item">
                    <i class="bi bi-chat-left-text"></i>
                    Submit Contact
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="menu-item logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>

            </nav>

        </aside>

        <!-- Main -->
        <main class="main-content">

            <!-- Topbar -->
            <header class="topbar">

                <div class="topbar-left">

                    <button class="menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="search-box">
                        <i class="bi bi-search"></i>

                        <input type="text" placeholder="Search Dashboard">
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

</body>