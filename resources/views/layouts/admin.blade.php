<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Hệ thống quản lý LapCare' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            overflow-x: hidden;
            font-size: 14px;
            background: #f7f7f7;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #f0ebfcff;
            padding: 20px 12px;
        }

        .sidebar .nav-link {
            color: #333;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background: #f5dccdff;
        }

        /* DROPDOWN ITEMS */
        .dropdown-item {
            font-size: 13px;
            padding: 7px 20px;
            border-radius: 5px;
            margin: 2px 0;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background: #efe3c6;
        }

        /* CONTENT WRAPPER */
        .content-wrapper {
            margin-left: 250px;
        }

        /* TOPBAR */
        .navbar-custom {
            background: #fff;
            border-bottom: 1px solid #e3e3e3;
            padding: 12px 20px;
        }

        .navbar-right a {
            margin-left: 15px;
            font-size: 14px;
            color: #751f8fff;
            text-decoration: none;
            transition: 0.2s;
        }

        .navbar-right a:hover {
            color: #c035eaff;
        }

        .title-gradient {
            background: linear-gradient(90deg, #9a63aeff, #8430a9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800 !important;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" 
            alt="Logo"
            class="sidebar-logo">

        @auth
            <div class="mt-3 d-flex justify-content-center align-items-center"
                style="font-size:17px; font-weight:600; color:#6a1b6a;">
                <i class="fa-solid fa-user-tie me-2"></i>
                {{ auth()->user()->name }}
            </div>
        @endauth
    </div>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home me-2"></i> Dashboard
            </a>
        </li>

        <!-- QUẢN LÝ DANH MỤC -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#cateMenu">
                <span><i class="fa fa-list me-2"></i> Quản Lý Danh Mục</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="cateMenu">
                <a class="dropdown-item" href="{{ route('categories.index') }}">Tất Cả Danh Mục</a>
                <a class="dropdown-item" href="{{ route('categories.create') }}">Thêm Danh Mục</a>
            </div>
        </li>

        <!-- QUẢN LÝ SẢN PHẨM -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#prodMenu">
                <span><i class="fa fa-box me-2"></i> Quản Lý Sản Phẩm</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="prodMenu">
                <a class="dropdown-item" href="{{ route('products.index') }}">Tất Cả Sản Phẩm</a>
                <a class="dropdown-item" href="{{ route('products.create') }}">Thêm Sản Phẩm</a>
            </div>
        </li>

        <!-- ĐÁNH GIÁ -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews.index') }}">
                <i class="fa fa-star me-2"></i> Quản Lý Đánh Giá
            </a>
        </li>

        <!-- ĐƠN HÀNG -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="fa fa-file me-2"></i> Quản Lý Đơn Hàng
            </a>
        </li>

        <!-- TÀI KHOẢN -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#accMenu">
                <span><i class="fa fa-user me-2"></i> Quản Lý Tài Khoản</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="accMenu">
                <a class="dropdown-item" href="{{ route('employees.index') }}">Tài Khoản Nhân Viên</a>
                <a class="dropdown-item" href="{{ route('customers.index') }}">Tài Khoản Khách Hàng</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#supplierMenu">
                <span><i class="fa fa-truck me-2"></i> Quản Lý Nhà Cung Cấp</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="supplierMenu">
                <a class="dropdown-item" href="{{ route('suppliers.index') }}">Tất Cả Nhà Cung Cấp</a>
                <a class="dropdown-item" href="{{ route('suppliers.create') }}">Thêm Nhà Cung Cấp</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#importMenu">
                <span><i class="fa fa-file-import me-2"></i> Quản Lý Đơn Nhập</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="importMenu">
                <a class="dropdown-item" href="{{ route('imports.index') }}">Tất Cả Đơn Nhập</a>
                <a class="dropdown-item" href="{{ route('imports.create') }}">Thêm Đơn Nhập</a>
            </div>
        </li>

    </ul>
</div>

<!-- CONTENT AREA -->
<div class="content-wrapper">

    <!-- TOP BAR -->
    <nav class="navbar navbar-custom d-flex align-items-center">
        <span class="fw-bold fs-5 title-gradient">{{ $title ?? 'DASHBOARD' }}</span>

        <div class="ms-auto navbar-right">
            <a href="{{ url('/') }}" target="_blank">
                <i class="fa fa-globe me-1"></i> Xem Website
            </a>

            <a href="#" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out-alt me-1"></i> Đăng Xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="p-4">
        @yield('content')
    </div>

</div>

</body>
</html>
