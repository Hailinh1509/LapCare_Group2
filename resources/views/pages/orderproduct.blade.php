{{-- resources/views/pages/checkout.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - LapCare</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body { background: #050b23; }
        .checkout-wrapper {
            max-width: 960px; margin: 24px auto 64px;
            background: #fff; border-radius: 16px;
            padding: 24px 24px 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .product-summary { border: 1px solid #e5e7eb; background: #f9fafb; padding: 12px; border-radius: 12px; }
        .product-summary img { width: 90px; height: 90px; object-fit: cover; border-radius: 10px; }
        .btn-confirm {
            background-color: #d9534f !important; color: white !important;
            border: none; padding: 12px 20px; border-radius: 6px; font-weight: 600;
        }
        .btn-confirm:hover { background-color: #c9302c !important; }
    </style>
</head>

<body>

@include('partials.header')

<div class="container">
    <div class="checkout-wrapper">

        {{-- Tiêu đề --}}
        <h3 class="mb-1">Thanh toán giỏ hàng</h3>
        <div class="text-muted mb-4">Kiểm tra thông tin trước khi hoàn tất đơn hàng.</div>

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                {{-- Cột trái --}}
                <div class="col-md-6">

                    <h5 class="mb-3">Thông tin khách hàng</h5>

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->sdt ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ nhận hàng</label>
                        <textarea name="address" class="form-control" rows="3" value="{{ auth()->user()->diachi ?? '' }}"required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi chú (nếu có)</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                {{-- Cột phải --}}
                <div class="col-md-6">

                    <h5 class="mb-3">Danh sách sản phẩm</h5>

                    @foreach($products as $item)
                        <div class="product-summary mb-2 d-flex gap-3 align-items-center">

                        @php
                                 $img = $item->hinhanh ? $item->hinhanh : 'assets/images/noimg.jpg';
                            @endphp

                            <img src="{{ asset($img) }}">

                            <div>
                                <div class="fw-bold">{{ $item->tensp }}</div>

                                <div class="text-danger fw-semibold">
                                    {{ number_format(($item->giasp - ($item->giasp * $item->khuyenmai)), 0, ',', '.') }} đ
                                </div>

                                <div class="text-muted small">
                                    Số lượng: <strong>{{ $item->soluong }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <h5 class="mt-4">Phương thức thanh toán</h5>

                    <div class="border p-3 rounded text-center mb-3">
                        <p class="fw-semibold">Quét mã QR thanh toán</p>
                        <img src="{{ asset('assets/images/QR.jpg') }}" style="max-width:220px;">
                        <p class="small text-muted mt-2">Nội dung chuyển khoản: <strong>{{ auth()->id() }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh xác nhận chuyển khoản</label>
                        <input type="file" class="form-control" name="payment_image">
                    </div>

                    <button type="submit" class="btn-confirm w-100 mt-3">Xác nhận thanh toán</button>

                </div>
            </div>

        </form>

    </div>
</div>

@include('partials.footer')

</body>
</html>
