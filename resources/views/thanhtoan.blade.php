{{-- resources/views/thanhtoan.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - LapCare</title>

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- CSS chung --}}
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background: #050b23;
        }

        .checkout-wrapper {
            max-width: 960px;
            margin: 24px auto 64px;
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 24px 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .checkout-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .checkout-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
        }

        .product-summary {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            background: #f9fafb;
        }

        .product-summary img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .qr-box {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            text-align: center;
            background: #f9fafb;
        }

        .qr-box img {
            max-width: 220px;
            width: 100%;
            border-radius: 12px;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    {{-- HEADER --}}
    @include('partials.header')

    <div class="container">
        {{-- FORM DUY NHẤT --}}
        <form action="{{ route('checkout.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- gửi mã sản phẩm sang controller --}}
            <input type="hidden" name="masp" value="{{ $product->masp ?? '' }}">

            <div class="checkout-wrapper">

                {{-- Tiêu đề --}}
                <div class="mb-3">
                    <div class="checkout-title">Thanh toán đơn hàng</div>
                    <div class="checkout-subtitle">
                        Vui lòng kiểm tra lại thông tin và tải lên ảnh xác nhận chuyển khoản (nếu có).
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Cột trái: thông tin khách hàng --}}
                    <div class="col-md-6">
                        <h5 class="mb-3">Thông tin khách hàng</h5>

                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control"
                                   value="{{ $customerName ?? 'Người dùng demo' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control"
                                   value="{{ $customerPhone ?? '0123456789' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ nhận hàng</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Nhập địa chỉ nhận hàng chi tiết">{{ $customerAddress ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú thêm (nếu có)</label>
                            <textarea name="note" class="form-control" rows="2"
                                      placeholder="Ví dụ: Giao giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                    </div>

                    {{-- Cột phải: sản phẩm + QR + upload --}}
                    <div class="col-md-6">
                        <h5 class="mb-3">Sản phẩm</h5>

                        <div class="product-summary mb-3 d-flex gap-3 align-items-center">
                            @php
                                $gia    = (float) ($product->giasp ?? 0);
                                $km     = (float) ($product->khuyenmai ?? 0);
                                $gia_km = $km > 0 ? $gia * (1 - $km) : $gia;

                                $img = trim($product->hinhanh ?? '', '/');
                                if (str_starts_with($img, 'assets/')) {
                                    //
                                } elseif (str_starts_with($img, 'images/')) {
                                    $img = 'assets/' . $img;
                                } else {
                                    $img = 'assets/images/' . $img;
                                }
                            @endphp

                            <div>
                                @if(!empty($product->hinhanh))
                                    <img src="{{ asset($img) }}" alt="{{ $product->tensp }}">
                                @else
                                    <div style="width:100px;height:100px;border-radius:12px;background:#eee;"></div>
                                @endif
                            </div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold">
                                    {{ $product->tensp ?? 'Sản phẩm' }} ({{ $product->masp ?? '' }})
                                </div>
                                <div class="text-danger fw-bold mt-1">
                                    {{ number_format($gia_km, 0, ',', '.') }} đ
                                </div>
                                @if($km > 0)
                                    <div class="small text-muted text-decoration-line-through">
                                        {{ number_format($gia, 0, ',', '.') }} đ
                                    </div>
                                    <div class="small text-success">Đang giảm {{ $km * 100 }}%</div>
                                @endif
                            </div>
                        </div>

                        <h5 class="mb-3">Phương thức thanh toán</h5>
                        <div class="qr-box mb-3">
                            <p class="mb-2 fw-semibold">Quét mã QR để thanh toán</p>
                            <img src="{{ asset('assets/images/QR.jpg') }}" alt="QR thanh toán">
                            <p class="mt-2 small text-muted mb-0">
                                Nội dung chuyển khoản:
                                <strong>{{ $product->masp ?? 'Mã sản phẩm' }}</strong> + SĐT
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh xác nhận đã chuyển khoản</label>
                            <input type="file" class="form-control" name="payment_image" accept="image/*">
                            <div class="form-text">
                                (Tùy chọn) Bạn có thể chụp màn hình giao dịch và tải lên để shop dễ kiểm tra hơn.
                            </div>
                        </div>

                        {{-- Nút submit --}}
                        <div class="d-grid mt-4">
                            <button type="submit"
                                    class="btn btn-danger w-100 mt-3">
                                Xác nhận đặt hàng
                            </button>
                        </div>
                    </div>
                </div>

            </div>{{-- /.checkout-wrapper --}}
        </form> {{-- ĐÓNG form DUY NHẤT --}}
    </div>{{-- /.container --}}

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
