<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức - LapCare</title>

    <!-- Bootstrap 5 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    >

    <!-- CSS chung: header/footer -->
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
    background: linear-gradient(180deg, #1a1f35, #14271fff);
}



        .news-page-wrapper {
            max-width: 1200px;
            margin: 120px auto 40px; /* chừa chỗ cho header */
            padding: 0 16px 40px;
        }

        .news-page-title {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .news-page-subtitle {
            color: #9ca3af;
            margin-bottom: 24px;
        }

        .news-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .news-card {
            background: #020617;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.25);
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.8);
        }

        .news-thumb {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
        }

        .news-body {
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .news-tag {
            display: inline-flex;
            align-items: center;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: rgba(56, 189, 248, 0.12);
            color: #22d3ee;
            margin-bottom: 8px;
        }

        .news-title {
            font-size: 18px;
            font-weight: 600;
            color: #e5e7eb;
            margin-bottom: 8px;
        }

        .news-meta {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 10px;
        }

        .news-excerpt {
            font-size: 14px;
            color: #d1d5db;
            margin-bottom: 12px;
            flex: 1;
        }

        .news-more {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            font-weight: 500;
            color: #f97316;
            text-decoration: none;
        }

        .news-more:hover {
            color: #fdba74;
        }

        .news-more i {
            font-style: normal;
            margin-left: 4px;
        }
    </style>
</head>
<body>

    {{-- HEADER dùng chung --}}
    @include('partials.header')

    <div class="news-page-wrapper">
        <h1 class="news-page-title">Tin tức & Khuyến mãi LapCare</h1>
        <p class="news-page-subtitle">
            Cập nhật xu hướng laptop, phụ kiện gaming và các chương trình ưu đãi mới nhất dành cho bạn.
        </p>

        <div class="news-list">
            {{-- Bài 1 --}}
            <article class="news-card">
                <img src="{{ asset('assets/images/banner1.jpg') }}"
                     alt="Săn deal Gaming Gear LapCare 2025"
                     class="news-thumb">
                <div class="news-body">
                    <span class="news-tag">Khuyến mãi</span>
                    <h2 class="news-title">
                        Săn deal Gaming Gear – Giảm đến 50% cho học sinh, sinh viên
                    </h2>
                    <div class="news-meta">
                        09/12/2025 • LapCare Hà Nội • Thời gian: 09 – 31/12/2025
                    </div>
                    <p class="news-excerpt">
                        Nhằm đồng hành mùa thi và mùa game cuối năm, LapCare triển khai chương trình giảm giá sâu
                        cho chuột, phím cơ, tai nghe, ghế gaming chính hãng. Mua kèm laptop được tặng balo,
                        lót chuột cỡ lớn và vệ sinh máy miễn phí trọn đời.
                    </p>
                    <a href="#" class="news-more">
                        Xem chi tiết <i>→</i>
                    </a>
                </div>
            </article>

            {{-- Bài 2 --}}
            <article class="news-card">
                <img src="{{ asset('assets/images/banner2.jpg') }}"
                     alt="Gợi ý laptop văn phòng 2025"
                     class="news-thumb">
                <div class="news-body">
                    <span class="news-tag">Tư vấn chọn mua</span>
                    <h2 class="news-title">
                        Top 5 laptop văn phòng – Pin trâu, màn đẹp, gõ sướng cho dân văn phòng
                    </h2>
                    <div class="news-meta">
                        05/12/2025 • Chuyên gia LapCare
                    </div>
                    <p class="news-excerpt">
                        Nếu bạn cần một chiếc laptop làm Word, Excel, họp Zoom cả ngày mà vẫn mỏng nhẹ,
                        mát mẻ, bài viết này gợi ý 5 mẫu máy nổi bật trong tầm 12–20 triệu, phù hợp cho
                        sinh viên và nhân viên văn phòng.
                    </p>
                    <a href="#" class="news-more">
                        Xem gợi ý <i>→</i>
                    </a>
                </div>
            </article>

            {{-- Bài 3 --}}
            <article class="news-card">
                <img src="{{ asset('assets/images/banner3.jpg') }}"
                     alt="Chính sách bảo hành LapCare"
                     class="news-thumb">
                <div class="news-body">
                    <span class="news-tag">Chính sách</span>
                    <h2 class="news-title">
                        Nâng cấp chính sách bảo hành 1 đổi 1 trong 30 ngày tại LapCare
                    </h2>
                    <div class="news-meta">
                        28/11/2025 • Trung tâm bảo hành LapCare
                    </div>
                    <p class="news-excerpt">
                        Từ tháng 12/2025, mọi laptop và phụ kiện mua tại hệ thống LapCare đều được áp dụng
                        chính sách bảo hành mới: hỗ trợ 1 đổi 1 trong 30 ngày nếu lỗi do nhà sản xuất,
                        kiểm tra – vệ sinh miễn phí và hỗ trợ cài đặt phần mềm trọn đời.
                    </p>
                    <a href="#" class="news-more">
                        Tìm hiểu thêm <i>→</i>
                    </a>
                </div>
            </article>
        </div>
    </div>

    {{-- FOOTER dùng chung --}}
    @include('partials.footer')

    {{-- Nút Messenger nổi (nếu có) --}}
    @include('partials.messenger')

</body>
</html>
