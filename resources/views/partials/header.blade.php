{{-- resources/views/partials/header.blade.php --}}

<!-- Top info bar -->
<div class="topbar">
    <div class="container">
        <div class="scrolling-text">
            <div class="inner">
                <div class="pill">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1a4 4 0 014 4h3a3 3 0 013 3v6a3 3 0 01-3 3h-3a4 4 0 01-4 4H6a3 3 0 01-3-3V5a4 4 0 014-4h5zm0 2H7a2 2 0 00-2 2v13a1 1 0 001 1h6a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                    </svg>
                    <span>Ưu đãi tiết kiệm</span>
                </div>
                <div class="pill">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 4h16v4H4zM4 10h16v10H4z"/>
                    </svg>
                    <span>Sản phẩm Chính hãng - Xuất VAT đầy đủ</span>
                </div>
                <div class="pill">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 6h13l5 5-5 5H3z"/>
                    </svg>
                    <span>Giao nhanh - Miễn phí cho đơn 300k</span>
                </div>
                <div class="pill">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 22l6-3 6 3V2H6z"/>
                    </svg>
                    <span>Thu cũ giá ngon - Lên đời dễ dàng</span>
                </div>
            </div>
        </div>

        <div class="pill">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l3 5h5l-4 4 2 6-6-3-6 3 2-6-4-4h5z"/>
            </svg>
            <span>Trung tâm bảo hành</span>
        </div>
        <div class="pill">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M4 6h16v12H4zM7 3h10v2H7z"/>
            </svg>
            <span>Linh kiện &amp; Phụ kiện</span>
        </div>
        <div class="pill">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011-.3 12 12 0 003.8.6 1 1 0 011 1V21a1 1 0 01-1 1A19 19 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 12 12 0 00.6 3.8 1 1 0 01-.3 1z"/>
            </svg>
            <span>0356 819 205</span>
        </div>
    </div>
</div>

<!-- Header -->
<header>
    <nav class="nav">
        <!-- Logo -->
        <a href="{{ !empty($loggedIn) && $loggedIn ? route('home.logged') : route('home') }}"
           class="logo" aria-label="LapCare">
            <img src="{{ asset('assets/images/logo.png') }}" alt="LapCare Logo" class="logo-img" />
        </a>

        <!-- Menu chính -->
        <div class="main-menu">
            {{-- Trang chủ --}}
            <a href="{{ !empty($loggedIn) && $loggedIn ? route('home.logged') : route('home') }}"
               class="action" aria-label="Trang chủ">
                <svg viewBox="0 0 25 25" fill="currentColor">
                    <path d="M3 12l9-9 9 9v9a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-9z"/>
                </svg>
                <span class="label">Trang chủ</span>
            </a>

            {{-- Sản phẩm --}}
            <div class="danhmuc">
                <a href="{{ route('products.index') }}" class="action" id="btnDanhMuc">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                    </svg>
                    <span class="label">Sản phẩm</span>
                </a>

                <div class="menu">
                    <div class="item">Văn phòng</div>
                    <div class="item">Gaming</div>
                    <div class="item">Sinh viên</div>
                    <div class="item">Cảm ứng</div>
                    <div class="item">Đồ hoạ - Kỹ thuật</div>
                    <div class="item">Phụ kiện</div>
                </div>
            </div>

            {{-- Tin tức --}}
            <a href="{{ route('news.index') }}" class="action" aria-label="Tin tức">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16v16H4z"></path>
                    <path d="M8 8h8"></path>
                    <path d="M8 12h8"></path>
                    <path d="M8 16h5"></path>
                </svg>
                <span class="label">Tin tức</span>
            </a>

            {{-- Liên hệ --}}
            <a href="{{ route('contact') }}" class="action" aria-label="Liên hệ">
                <svg viewBox="0 0 25 25" fill="currentColor">
                    <path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.21c1.2.48 2.53.74 3.91.74a1 1 0 011 1v3.5a1 1 0 01-1 1C10.61 22 2 13.39 2 3.5a1 1 0 011-1H6.5a1 1 0 011 1c0 1.38.26 2.71.74 3.91a1 1 0 01-.21 1.11l-2.41 2.27z"/>
                </svg>
                <span class="label">Liên hệ</span>
            </a>

            <!-- Search -->
            <form class="search"
                  role="search"
                  aria-label="Tìm kiếm"
                  method="GET"
                  action="{{ route('home') }}">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a8 8 0 015.292 13.708l4 4-1.414 1.414-4-4A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                <input type="search"
                       name="keyword"
                       value="{{ request('keyword') }}"
                       placeholder="Bạn muốn mua gì hôm nay?" />
            </form>

            <!-- Right actions -->
            {{-- Giỏ hàng --}}
            <a href="{{ route('cart') }}" class="action" aria-label="Giỏ hàng">
                <svg viewBox="0 0 21 21" fill="currentColor">
                    <path d="M7 18a2 2 0 104 0 2 2 0 00-4 0zm7 0a2 2 0 104 0 2 2 0 00-4 0zM6 6h14l-2 7H8zM4 4h2l1 4h12v2H8l-2 7H4z"/>
                </svg>
                <span class="label">Giỏ hàng</span>
            </a>

            @if(!empty($loggedIn) && $loggedIn)
                {{-- ĐÃ ĐĂNG NHẬP: hiện icon user + dropdown --}}
                <div class="action user-menu">
                    <svg viewBox="0 0 23 23" fill="currentColor">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5 0-9 3-9 6v2h18v-2c0-3-4-6-9-6z"/>
                    </svg>
                    <span class="label">Xin chào, User</span> {{-- sau này thay bằng tên user thật --}}

                    <div class="user-dropdown">
                        <a href="#">Tài khoản của tôi</a>
                        <a href="#">Đổi mật khẩu</a>

                        {{-- sau này bạn trỏ action vào route logout --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>

                    </div>
                </div>
            @else
                {{-- CHƯA ĐĂNG NHẬP: nút Đăng nhập --}}
                <a href="{{ route('login') }}" class="action" aria-label="Đăng nhập">
                    <svg viewBox="0 0 23 23" fill="currentColor">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5 0-9 3-9 6v2h18v-2c0-3-4-6-9-6z"/>
                    </svg>
                    <span class="label">Đăng nhập</span>
                </a>
            @endif

        </div>
    </nav>
</header>
