<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Bakya Admin' }}</title>

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
            background: #eadfc4;
            padding: 20px 12px;
        }

        .sidebar .nav-link {
            color: #333;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
        }

        .sidebar .nav-link:hover {
            background: #d8c8a2;
        }

        /* DROPDOWN ITEMS */
        .dropdown-item {
            font-size: 13px;
            padding: 7px 20px;
            border-radius: 5px;
            margin: 2px 0;
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
        }

        .navbar-right a:hover {
            text-decoration: none;
            color: #c035eaff;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4 class="fw-bold text-center mb-4">Bakya</h4>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-home me-2"></i> Dashboard
            </a>
        </li>

        <!-- QUẢN LÝ DANH MỤC -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between"
               data-bs-toggle="collapse" href="#cateMenu">
                <span><i class="fa fa-list me-2"></i> Quản lý danh mục</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="cateMenu">
                <a class="dropdown-item" href="{{ route('categories.index') }}">Tất cả danh mục</a>
                <a class="dropdown-item" href="{{ route('categories.create') }}">Thêm danh mục</a>
            </div>
        </li>

        <!-- QUẢN LÝ SẢN PHẨM -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between"
               data-bs-toggle="collapse" href="#prodMenu">
                <span><i class="fa fa-box me-2"></i> Quản lý sản phẩm</span>
                <i class="fa fa-chevron-down small"></i>
            </a>
            <div class="collapse ps-2" id="prodMenu">
                <a class="dropdown-item" href="{{ route('products.index') }}">Tất cả sản phẩm</a>
                <a class="dropdown-item" href="{{ route('products.create') }}">Thêm sản phẩm</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews.index') }}">
                <i class="fa fa-star me-2"></i> Quản lý đánh giá
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('contacts.index') }}">
                <i class="fa fa-envelope me-2"></i> Quản lý liên hệ
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="fa fa-file me-2"></i> Quản lý đơn hàng
            </a>
        </li>

        <!-- TÀI KHOẢN -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between"
               data-bs-toggle="collapse" href="#accMenu">
                <span><i class="fa fa-user me-2"></i> Quản lý tài khoản</span>
                <i class="fa fa-chevron-down small"></i>
            </a>

            <div class="collapse ps-2" id="accMenu">
                <a class="dropdown-item" href="{{ route('accounts.index') }}">Tất cả tài khoản</a>

                <div class="ps-3">
                    <a class="dropdown-item" href="{{ route('employees.index') }}">Tài khoản nhân viên</a>
                    <a class="dropdown-item" href="{{ route('customers.index') }}">Tài khoản khách hàng</a>
                </div>

                <a class="dropdown-item" href="{{ route('accounts.create') }}">Thêm tài khoản</a>
            </div>
        </li>
    </ul>
</div>

<!-- CONTENT AREA -->
<div class="content-wrapper">

    <!-- TOP BAR -->
    <nav class="navbar navbar-custom">
        <span class="fw-bold fs-5">{{ $title ?? 'Dashboard' }}</span>

        <div class="ms-auto navbar-right">
            <a href="{{ url('/') }}" target="_blank">
                <i class="fa fa-globe me-1"></i> Xem website
            </a>

            <a href="#">
                <i class="fa fa-sign-out-alt me-1"></i> Đăng xuất
            </a>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="p-4">
        @yield('content')
    </div>

</div>

</body>
</html>
