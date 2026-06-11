<!DOCTYPE html>
<html>

<head>
    <title>EGEAD CMS Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ Storage::url($about_us->favicon) }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
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

                <a href="{{ route('admin.about_us') }}"
                    class="menu-item {{ request()->routeIs('admin.about_us') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Information</span>
                </a>

                @if (Auth::user()->role === 'superAdmin')
                    <a href="{{ route('admin.users') }}"
                        class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                @endif

                <a href="{{ route('admin.media') }}"
                    class="menu-item {{ request()->routeIs('admin.media') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Media</span>
                </a>

                <div class="menu-group">
                    <button class="menu-item submenu-toggle {{ request()->routeIs('admin.blogs') || request()->routeIs('admin.categories') ? 'active' : '' }}">
                        <div>
                            <i class="bi bi-journal-text"></i>
                            <span>Blogs</span>
                        </div>

                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div class="submenu">
                        <a href="{{ route('admin.blogs') }}" class="submenu-item {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                            Blog Management
                        </a>

                        <a href="{{ route('admin.categories') }}" class="submenu-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                            Category Management
                        </a>
                    </div>
                </div>

                @if (Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin')
                    <div class="menu-group">
                        <button class="menu-item submenu-toggle {{ request()->routeIs('admin.services') || request()->routeIs('admin.service_categories') ? 'active' : '' }}">
                            <div>
                                <i class="bi bi-briefcase"></i>
                                <span>Services</span>
                            </div>

                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <div class="submenu">
                            <a href="{{ route('admin.services') }}"
                                class="submenu-item {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                                Service Management
                            </a>

                            <a href="{{ route('admin.service_categories') }}"
                                class="submenu-item {{ request()->routeIs('admin.service_categories') ? 'active' : '' }}">
                                Category Management
                            </a>
                        </div>
                    </div>

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
                @endif

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

                    <div class="search-box input-group">
                        <i class="bi bi-search text-muted p-2"></i>

                        <input type="text" placeholder="Search" class="form-control">
                    </div>

                </div>

                <div class="topbar-right">

                    <div class="notification">
                        <i class="bi bi-bell"></i>
                    </div>

                    <div class="user-profile">

                        <div class="avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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

    {{-- MARK AS SEEN --}}
    <script>
        document.querySelectorAll('.mark-seen-btn').forEach(button => {

            button.addEventListener('click', function() {

                const id = this.dataset.id;
                const status = this.dataset.status;

                if (status !== 'new') {
                    return;
                }

                fetch(`/admin/submit-contacts/${id}/seen`, {

                        method: 'PUT',

                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }

                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.success) {

                            this.dataset.status = 'seen';

                            const tableBadge = document.getElementById(`table-status-badge-${id}`);

                            const modalBadge = document.getElementById(`modal-status-badge-${id}`);

                            modalBadge.innerText = 'Seen';

                            modalBadge.classList.remove(
                                'bg-red-100',
                                'text-red-600'
                            );

                            modalBadge.classList.add(
                                'bg-blue-100',
                                'text-blue-600'
                            );

                            tableBadge.innerText = 'Seen';

                            tableBadge.classList.remove(
                                'bg-red-100',
                                'text-red-600'
                            );

                            tableBadge.classList.add(
                                'bg-blue-100',
                                'text-blue-600'
                            );

                        }

                    })
                    .catch(error => console.log(error));

            });

        });
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

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    {{-- CKEDITOR 5 --}}
    <script>
        document.querySelectorAll('.ckeditor').forEach(editor => {

            let folder = editor.dataset.folder || 'editor';

            ClassicEditor.create(editor, {

                    ckfinder: {
                        uploadUrl: "/ckeditor/upload-image/{folder}?_token={{ csrf_token() }}"
                    }

                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>

    {{-- SUBMENU TOGGLE --}}
    <script>
        document.querySelectorAll('.submenu-toggle').forEach(toggle => {

            toggle.addEventListener('click', () => {

                const submenu = toggle.nextElementSibling;

                submenu.classList.toggle('show');

            });

        });
    </script>

    {{-- COPY URL --}}
    <script>
        document.querySelectorAll('.copy-url')
            .forEach(button => {

                button.addEventListener('click', function(){

                    navigator.clipboard.writeText(
                        this.dataset.url
                    );

                    Swal.fire({
                        icon:'success',
                        title:'Copied',
                        timer:1200,
                        showConfirmButton:false
                    });

                });

        });
    </script>

    {{-- UPLOAD IMAGE --}}
    <script>

        const uploadZone = document.querySelector('.upload-zone');
        const fileInput = document.getElementById('mediaFile');

        uploadZone.addEventListener('click', () => {

            fileInput.click();

        });

        uploadZone.addEventListener('dragover', e => {

            e.preventDefault();

            uploadZone.classList.add('active');

        });

        uploadZone.addEventListener('dragleave', () => {

            uploadZone.classList.remove('active');

        });

        uploadZone.addEventListener('drop', e => {

            e.preventDefault();

            uploadZone.classList.remove('active');

            fileInput.files = e.dataTransfer.files;

        });

        fileInput.addEventListener('change', () => {

            if(fileInput.files.length){

                uploadZone.querySelector('p').innerText =
                    fileInput.files[0].name;

            }

        });

    </script>

    <script>

        const dropzone = document.getElementById('dropzone');
        const input = document.getElementById('mediaInput');
        const preview = document.getElementById('previewArea');

        let selectedFiles = new DataTransfer();

        dropzone.onclick = () => input.click();

        dropzone.addEventListener('dragover', function (e) {

            e.preventDefault();

            dropzone.classList.add('dragging');

        });

        dropzone.addEventListener('dragleave', function () {

            dropzone.classList.remove('dragging');

        });

        dropzone.addEventListener('drop', function (e) {

            e.preventDefault();

            dropzone.classList.remove('dragging');

            addFiles(e.dataTransfer.files);

        });

        input.addEventListener('change', function () {

            addFiles(this.files);

        });

        function addFiles(files) {

            [...files].forEach(file => {

                const exists = [...selectedFiles.files].some(existingFile => {

                    return existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified;

                });

                if (exists) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Duplicate file',
                        text: `${file.name} already exists`
                    });

                    return;

                }

                selectedFiles.items.add(file);

            });

            input.files = selectedFiles.files;

            renderPreview();

        }

        function removeFile(index) {

            const newFiles = new DataTransfer();

            [...selectedFiles.files].forEach((file, i) => {

                if (i !== index) {

                    newFiles.items.add(file);

                }

            });

            selectedFiles = newFiles;

            input.files = selectedFiles.files;

            renderPreview();

        }

        function renderPreview() {

            preview.innerHTML = '';

            [...selectedFiles.files].forEach((file, index) => {

                if (!file.type.startsWith('image/')) {

                    return;

                }

                const reader = new FileReader();

                reader.onload = function (e) {

                    const item = document.createElement('div');

                    item.classList.add('preview-item');

                    item.innerHTML = `
                        <img
                            src="${e.target.result}"
                            class="preview-image">

                        <button
                            type="button"
                            class="remove-file">

                            <i class="bi bi-x-lg"></i>

                        </button>
                    `;

                    item.querySelector('.remove-file')
                        .addEventListener('click', function () {

                            removeFile(index);

                        });

                    preview.appendChild(item);

                };

                reader.readAsDataURL(file);

            });

        }

        document.querySelectorAll('.copy-url').forEach(btn => {

            btn.addEventListener('click', () => {

                navigator.clipboard.writeText(btn.dataset.url);

                Swal.fire({
                    icon: 'success',
                    title: 'Copied',
                    text: 'URL copied to clipboard',
                    timer: 1500,
                    showConfirmButton: false
                });

            });

        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
