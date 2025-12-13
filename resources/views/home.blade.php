<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ LapCare</title>

    <!-- Bootstrap 5 (giữ nguyên) -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    >

    <!-- CSS chung: header/footer -->
<link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">


    <!-- CSS chính của web cũ -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- CSS trang sản phẩm (sanpham) nếu còn dùng chung hiệu ứng, slide... -->
    <link rel="stylesheet" href="{{ asset('assets/css/sanpham.css') }}">

    <!-- Swiper CSS (giống sanpham.php) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- CSS ép layout trang chủ -->
    <style>
        /* BANNER TRƯỢT */
        .banner-slide {
            width: 100%;
            max-width: 2920px;
            height: 420px;
            margin: 16px 0;
            border-radius: 20px;
            overflow: hidden;
        }
        .banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: #f9f9f9;
            display: block;
        }

        /* Lưới sản phẩm nổi bật – dùng flex cho chắc chắn */
        .home-product-grid .row-products {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .home-product-grid .row-products > .col-product {
            float: none !important;
            flex: 0 0 100%;
        }
        @media (min-width: 768px) {
            .home-product-grid .row-products > .col-product {
                flex: 0 0 calc(50% - 12px);
            }
        }
        @media (min-width: 992px) {
            .home-product-grid .row-products > .col-product {
                flex: 0 0 calc(25% - 12px);
            }
        }

        /* Style nút Chi tiết / Thêm ở Sản phẩm nổi bật */
        .home-product-grid .product-card .btn-detail-home,
        .home-product-grid .product-card .btn-add-home {
            border-radius: 999px;
            font-weight: 500;
            font-size: 14px;
            padding: 0 16px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            text-align: center;
        }

        /* Nút "Chi tiết" – nền trắng, viền đỏ, chữ đỏ */
        .home-product-grid .product-card .btn-detail-home {
            background-color: #ffffff !important;
            border: 1px solid #ff4b8b !important;
            color: #ff4b8b !important;
        }

        /* Nút "Thêm" – nền đỏ, chữ trắng */
        .home-product-grid .product-card .btn-add-home {
            background-color: #ff4b8b !important;
            border: 1px solid #ff4b8b !important;
            color: #ffffff !important;
        }

        /* Hover giống bản cũ */
        .home-product-grid .product-card .btn-detail-home:hover {
            background-color: #ffe6ef !important;
        }

        .home-product-grid .product-card .btn-add-home:hover {
            background-color: #e11d48 !important;
            border-color: #e11d48 !important;
        }

        /* NÚT MUA NGAY TRONG FLASH SALE */
        .flash-sale .btn {
            background-color: #ff4b8b !important;
            border-color: #ff4b8b !important;
            color: #ffffff !important;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
            padding: 0 16px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }
        .flash-sale .btn:hover {
            background-color: #e11d48 !important;
            border-color: #e11d48 !important;
        }
    </style>
</head>
<body>

    @include('partials.header')
    

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <div class="container mt-4">

        <!-- 1. BANNER TRƯỢT -->
        <div class="swiper banner-slide">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/banner1.jpg') }}" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/banner2.jpg') }}" alt="Banner 2">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/banner3.jpg') }}" alt="Banner 3">
                </div>
            </div>
        </div>

        <script>
            // Khởi tạo Swiper cho banner trang chủ
            new Swiper('.banner-slide', {
                loop: true,
                autoplay: { delay: 3000 },
            });
        </script>

        <!-- 2. GIỚI THIỆU LAPCARE (giữ nguyên nội dung tĩnh) -->
        <section class="intro-lapcare mb-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="intro-text">
                        <p>
                            Trong bối cảnh công nghệ thông tin đang phát triển ngày càng mạnh mẽ, nhu cầu sử dụng các thiết bị
                            điện tử đặc biệt như máy tính để thực hiện các công việc hàng ngày như học tập, công việc cũng ngày
                            một tăng cao. Cũng từ đó ý tưởng website kinh doanh máy tính và phụ kiện điện tử được xây dựng nhằm
                            tạo ra một nền tảng thương mại điện tử chuyên cung cấp cho những tín đồ đam mê công nghệ cũng như
                            những người dùng có nhu cầu sử dụng chúng.
                        </p>
                        <p>
                            Website cung cấp đa dạng sản phẩm như laptop, PC lắp ráp, màn hình, bàn phím, chuột, tai nghe và
                            các thiết bị nâng cấp phần cứng. Hệ thống được thiết kế theo hướng tập trung vào trải nghiệm người
                            dùng, tối ưu quá trình tìm kiếm, so sánh, đặt hàng, đồng thời áp dụng các gợi ý sản phẩm thông minh
                            giúp khách hàng lựa chọn phù hợp theo nhu cầu học tập, làm việc, gaming.
                        </p>
                        <p>
                            Bên cạnh đó, khách hàng cũng có thể tìm thấy những sản phẩm mới nhất từ các thương hiệu nổi tiếng
                            như Apple, Asus, Lenovo, Dell, MSI... giúp cho khách hàng luôn được tiếp cận một cách nhanh nhất đến
                            công nghệ.
                        </p>
                        <p>
                            Chúng tôi tự tin rằng, khi đến với website của chúng tôi, các bạn sẽ lựa chọn được những sản phẩm
                            ưng ý, với giá thành rẻ cùng như chất lượng tốt nhất trong từng phân khúc giá.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="intro-card text-center">
                        <h5 class="fw-bold mb-2">Lapcare – Laptop &amp; Phụ kiện</h5>
                        <p class="small mb-3">
                            Nền tảng mua sắm thiết bị công nghệ dành cho học tập, làm việc và giải trí.
                        </p>
                        <ul class="list-unstyled small text-start d-inline-block">
                            <li>• Laptop chính hãng, đa dạng cấu hình</li>
                            <li>• Phụ kiện văn phòng &amp; gaming</li>
                            <li>• Tư vấn theo nhu cầu sử dụng</li>
                            <li>• Bảo hành uy tín, hỗ trợ nhanh</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. FLASH SALE (dùng dữ liệu từ controller) -->
        @if($flashProducts->isNotEmpty())
            <section class="flash-sale mb-4">
                <div class="flash-sale-header d-flex justify-content-between align-items-center">
                    <div class="fs-title">
                        ⚡ FLASH SALE LAPCARE – GIẢM SỐC HÔM NAY ⚡
                    </div>
                    <div class="fs-timer small">
    Kết thúc sau:
    <span
        id="fs-countdown"
        data-end-time="{{ $flashEndTime * 1000 }}"
    >
        00 ngày 00:00:00
    </span>
</div>

                </div>

                <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
                    @foreach($flashProducts as $p)
                        @php
                            $gia    = (float) $p->giasp;
                            $km     = (float) $p->khuyenmai;
                            $gia_km = $km > 0 ? $gia * (1 - $km) : $gia;
                        @endphp
                        <div class="col">
                            <div class="flash-item h-100">
@php
    $img = trim($p->hinhanh, '/'); // VD: images/SP001.jpg

    if (str_starts_with($img, 'assets/')) {
        // đã đúng "assets/..." rồi thì giữ nguyên
    } elseif (str_starts_with($img, 'images/')) {
        // DB dạng "images/SP001.jpg" → thành "assets/images/SP001.jpg"
        $img = 'assets/' . $img;
    } else {
        // nếu chỉ là "SP001.jpg" → gắn "assets/images/SP001.jpg"
        $img = 'assets/images/' . $img;
    }
@endphp

<img src="{{ asset($img) }}" alt="{{ $p->tensp }}">



                                <p class="name mb-1">
                                    {{ $p->tensp }}
                                </p>

                                <p class="price-sale mb-0">
                                    {{ number_format($gia_km, 0, ',', '.') }} đ
                                </p>

                                @if($km > 0)
                                    <p class="price-original mb-1">
                                        <del>{{ number_format($gia, 0, ',', '.') }} đ</del>
                                        <span class="badge-km">-{{ $km * 100 }}%</span>
                                    </p>
                                @endif

                                {{-- Tạm thời vẫn để link cũ, khi có route Laravel thì đổi sau --}}
                                <a href="{{ route('buy.now', ['masp' => $p->masp]) }}" class="btn btn-danger btn-sm w-100 mt-1">
    Mua ngay
</a>


                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 4. SẢN PHẨM NỔI BẬT -->
        <section class="home-product-grid mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">
                    {{ $heading }}
                </h4>
                <span class="text-muted small">
                    Có {{ $products->count() }} sản phẩm
                </span>
            </div>

            <div class="row-products">
                @foreach($products as $p)
                    @php
                        $gia    = (float) $p->giasp;
                        $km     = (float) $p->khuyenmai;
                        $gia_km = $km > 0 ? $gia * (1 - $km) : $gia;
                    @endphp
                    <div class="col-product">
                        <div class="card h-100 shadow-sm product-card position-relative">
                            @if($km > 0)
                                <span class="badge bg-danger position-absolute m-2">
                                    -{{ $km * 100 }}%
                                </span>
                            @endif

                           @php
    $img = trim($p->hinhanh, '/'); // images/SP004.jpg ...

    if (str_starts_with($img, 'assets/')) {
        // OK
    } elseif (str_starts_with($img, 'images/')) {
        $img = 'assets/' . $img; // assets/images/SP004.jpg
    } else {
        $img = 'assets/images/' . $img;
    }
@endphp

<img src="{{ asset($img) }}"
     class="card-img-top"
     alt="{{ $p->tensp }}">



                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">
                                    {{ $p->tensp }}
                                </h6>

                                <p class="mb-1 text-danger fw-bold">
                                    {{ number_format($gia_km, 0, ',', '.') }} đ
                                </p>

                                @if($km > 0)
                                    <p class="mb-1 small text-muted text-decoration-line-through">
                                        {{ number_format($gia, 0, ',', '.') }} đ
                                    </p>
                                @endif

                                <p class="small text-muted mb-2">
                                    {{ $p->hang }}
                                    @if($p->ram) · {{ $p->ram }} @endif
                                    @if($p->cpu) · {{ $p->cpu }} @endif
                                </p>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('products.detail', ['masp' => $p->masp]) }}"
                                       class="btn btn-outline-secondary btn-sm flex-grow-1 btn-detail-home">
                                        Chi tiết
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
    @csrf
    <input type="hidden" name="masp" value="{{ $p->masp }}">
    <input type="hidden" name="soluong" value="1">
    
    <button type="submit" class="btn btn-danger btn-sm flex-grow-1 btn-add-home">
        Thêm
    </button>
</form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($products->isEmpty())
                    <p>Không tìm thấy sản phẩm phù hợp.</p>
                @endif
            </div>
        </section>

    </div>

    {{-- Countdown cho Flash Sale --}}
    @if($flashProducts->isNotEmpty())
<script>
    (function () {
        const countdownEl = document.getElementById('fs-countdown');
        if (!countdownEl) return;

        // Lấy endTime từ HTML (data-end-time)
        const endTimeAttr = countdownEl.getAttribute('data-end-time');
        const endTime = parseInt(endTimeAttr, 10);

        function updateCountdown() {
            const now = Date.now();
            let diff = Math.floor((endTime - now) / 1000);

            if (diff <= 0) {
                countdownEl.textContent = "00 ngày 00:00:00";
                clearInterval(timer);
                return;
            }

            const days = Math.floor(diff / 86400);
            diff %= 86400;
            const hours = String(Math.floor(diff / 3600)).padStart(2, "0");
            diff %= 3600;
            const mins = String(Math.floor(diff / 60)).padStart(2, "0");
            const secs = String(diff % 60).padStart(2, "0");

            countdownEl.textContent = `${days} ngày ${hours}:${mins}:${secs}`;
        }

        updateCountdown();
        const timer = setInterval(updateCountdown, 1000);
    })();
</script>
@endif

@include('footer.footer')

 {{-- Nút Messenger nổi bên phải --}}
    @include('partials.messenger')
</body>
</html>
