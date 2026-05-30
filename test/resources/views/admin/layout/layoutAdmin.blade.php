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
    <link rel="stylesheet" href="{{ asset('admin.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-layout">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="sidebar-header">
            <div class="logo">
                <x-application-logo class="w-40 h-40 fill-current text-gray-500" />
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="/admin/dashboard" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </div>
            
            <div class="sidebar-item" >   
                <a href="/admin/users" class="sidebar-link {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.users') ? 'active' : '' }}">
                    Users
                </a>   
            </div>

            <div class="sidebar-item">
                <a href="/admin/blogs" class="sidebar-link {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    Blogs
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="/admin/services" class="sidebar-link {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                    Services
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="/admin/recruitments" class="sidebar-link {{ request()->routeIs('admin.recruitments') ? 'active' : '' }}">
                    Recruitments
                </a>   
            </div>

            <div class="sidebar-item">
                <a href="/admin/submit-emails" class="sidebar-link {{ request()->routeIs('admin.submit_emails') ? 'active' : '' }}">
                    Submit Email
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="/admin/submit-contacts" class="sidebar-link {{ request()->routeIs('admin.submit_contacts') ? 'active' : '' }}">
                    Submit Contact
                </a>   
            </div>    
            
            <form method="POST" action="{{ route('logout') }}" class="sidebar-item">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>
        </div> 
    </div>

    <!-- CONTENT -->

    <div class="content">
        <div class="topbar">
            <div class="admin-info">
                <div>
                    <h2>
                        Welcome {{ Auth::user()->name }} 👋
                    </h2>

                    <p class="admin-role">
                        {{ Auth::user()->role == 'superAdmin' ? 'Super Admin' : ucfirst(Auth::user()->role) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>
    </div>

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

        button.addEventListener('click', function () {

            const contactId = this.dataset.id;

            fetch(`/admin/api/submit-contacts/${contactId}/seen`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    console.log(data.message);
                } else {
                    alert(data.message);
                }

            })
            .catch(error => {
                console.error(error);
                alert('Có lỗi xảy ra khi cập nhật trạng thái.');
            });

        });

    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>