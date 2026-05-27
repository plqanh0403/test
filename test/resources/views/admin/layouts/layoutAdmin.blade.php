<!DOCTYPE html>
<html>
<head>
    <title>EGEAD CMS Admin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/admin.css') }}">

    <style>
        *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        }

        body{
            font-family:'Poppins', sans-serif;
            background:#f4f6f9;
            display:flex;
        }

        /* SIDEBAR */

        .sidebar{
            width:250px;
            height:100vh;
            background:linear-gradient(180deg, #bcd6ff, #0a1122);
            color:white;
            position:fixed;
            left:0;
            top:0;
            padding:25px 20px;
        }

        .logo{
            font-size:24px;
            font-weight:600;
            margin-bottom:40px;
            text-align:center;
            letter-spacing:1px;
        }

        .menu-title{
            font-size:13px;
            color:#0a1122;
            margin-bottom:15px;
            text-transform:uppercase;
        }

        /* SIDEBAR ITEM */

        .sidebar-item{
            margin-bottom:10px;
        }

        /* MENU LINK + BUTTON */

        .sidebar-item a,
        .sidebar-item button{
            width:100%;
            display:flex;
            align-items:center;
            padding:14px 16px;
            border:none;
            border-radius:10px;
            background:none;
            color:#e2e8f0;
            text-decoration:none;
            font-size:15px;
            font-family:'Poppins', sans-serif;
            cursor:pointer;
            transition:0.3s;
        }

        /* HOVER */

        .sidebar-item a:hover, .sidebar-item button:hover{
            background:#334155;
            transform:translateX(5px);
        }

        /* ACTIVE */

        .sidebar-item a.active{
            background:#3b82f6;
            color:white;
        }

        /* CONTENT */

        .content{
            margin-left:250px;
            width:100%;
            padding:30px;
        }

        .topbar{
            background:white;
            padding:18px 25px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
            margin-bottom:25px;
        }

        .topbar h2{
            font-size:22px;
            color:#1e293b;
        }

        .page-content{
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.06);
            min-height:500px;
        }

    </style>
</head>

<body class="admin-layout">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <div class="sidebar-item">
            <a href="/admin/dashboard" class="active">
                Dashboard
            </a>
        </div>
        
        <div class="sidebar-item">
            <a href="#">
                Users
            </a>   
        </div>

        <div class="sidebar-item">
            <a href="#">
                Blogs
            </a>
        </div>
        
        <div class="sidebar-item">
            <a href="#" >
                Services
            </a>
        </div>
        
        <div class="sidebar-item">
            <a href="#">
                Recruitments
            </a>   
        </div>
           

        <form method="POST" action="{{ route('logout') }}" class="sidebar-item">

                @csrf

                <button type="submit">
                    Logout
                </button>

        </form>

    </div>

    <!-- CONTENT -->

    <div class="content">

        <div class="topbar">
            <h2>Welcome Admin 👋</h2>
        </div>

        <div class="page-content">
 
            {{-- content render here --}}
            @yield('content')

        </div>

    </div>

</body>
</html>