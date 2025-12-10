@extends('pages.accounts.layout')

@section('title', 'Chi Tiết Đơn Hàng')

@section('account-content')

<style>
    .order-title {
        font-size: 22px;
        font-weight: 700;
        color: #4B0082;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .order-info-box {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        border-left: 4px solid #4B0082;
        margin-bottom: 20px;
    }

    .order-info-box .row div {
        margin-bottom: 6px;
        font-size: 14px;
    }

    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .orders-table * {
        font-size: 13px !important;
    }

    .back-btn {
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        color: #4B0082;
        border-color: #4B0082;
        transition: 0.2s;
    }
    .back-btn:hover {
        background-color: #4B0082;
        color: white;
    }

    /* Star rating */
    .star-rating input { display: none; }
    .star-rating label {
        font-size: 20px;
        color: #ccc;
        cursor: pointer;
        margin-right: 2px;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #FFD700;
    }

    .rating-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 12px;
    }

    .btn-rate {
        display: inline-block;       /* inline-block để căn sang phải */
        float: right;                /* căn sang bên phải */
        margin-top: 10px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 600;
        color: white;
        background:  #6a0dad;
        border: none;
        border-radius: 6px;          /* hình chữ nhật bo nhẹ */
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-rate:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 14px rgba(0,0,0,0.25);
        background: linear-gradient(90deg, #ff69b4, #4b0082, #6a0dad);
    }
</style>

<div class="container-fluid">

    <div class="card" style="border: none; box-shadow: none;">
        <div class="card-header text-white" style="padding: 8px 14px;">
            <h5 class="order-title mb-0" style="font-size: 18px;">
                Chi Tiết Đơn Hàng #{{ $order->madh }}
            </h5>
        </div>

        <div class="card-body" style="padding: 15px 14px;">

            {{-- Thông báo --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Thông tin đơn hàng --}}
            <div class="order-info-box">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Ngày đặt:</strong>
                        {{ \Carbon\Carbon::parse($order->ngaydat)->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Phương thức thanh toán:</strong>
                        {{ $order->pttt }}
                    </div>
                    <div class="col-md-6">
                        <strong>Trạng thái thanh toán:</strong>
                        <span class="badge bg-{{ $order->ttthanhtoan == 'Đã thanh toán' ? 'success' : 'warning' }}">
                            {{ $order->ttthanhtoan }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Trạng thái vận chuyển:</strong>
                        <span class="badge bg-{{ $order->ttvanchuyen == 'Đã giao' ? 'success' : 'secondary' }}">
                            {{ $order->ttvanchuyen }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Chi tiết sản phẩm --}}
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover align-middle orders-table">
                    <thead class="table-light text-center fw-bold">
                        <tr>
                            <th>Hình</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $ct)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset($ct->hinhanh) }}" class="img-thumbnail" width="70">
                            </td>
                            <td><strong>{{ $ct->tensp }}</strong></td>
                            <td class="text-center">{{ $ct->soluong }}</td>
                            <td class="text-end">{{ number_format($ct->dongia, 0, ',', '.') }} đ</td>
                            <td class="text-end">{{ number_format($ct->soluong * $ct->dongia, 0, ',', '.') }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @php
                        $tongtien = $details->sum(fn($i) => $i->soluong * $i->dongia);
                        $tongthanhtoan = $tongtien + $order->phivanchuyen + $order->VAT;
                    @endphp
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng tiền hàng:</th>
                            <th class="text-end">{{ number_format($tongtien, 0, ',', '.') }} đ</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end">Phí vận chuyển:</th>
                            <th class="text-end">{{ number_format($order->phivanchuyen, 0, ',', '.') }} đ</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end">VAT:</th>
                            <th class="text-end">{{ number_format($order->VAT, 0, ',', '.') }} đ</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end text-primary">Tổng thanh toán:</th>
                            <th class="text-end text-primary">{{ number_format($tongthanhtoan, 0, ',', '.') }} đ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Form đánh giá sản phẩm --}}
            <div class="mt-4">
                <h5 class="order-title mb-0" style="color: #4B0082; font-size: 18px;  padding-bottom: 8px">Đánh Giá Sản Phẩm</h5>

                @foreach($details as $ct)
                <div class="rating-card">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($ct->hinhanh) }}" class="img-thumbnail me-3" width="70">
                        <div class="flex-grow-1">
                            <strong>{{ $ct->tensp }}</strong>

                            @php
                                $existingRating = $ratings->firstWhere('masp', $ct->masp);
                            @endphp

                            @if($existingRating)
                                {{-- Hiển thị đánh giá đã có --}}
                                <div class="mt-2">
                                    @for($i=1; $i<=5; $i++)
                                        <span style="color: {{ $i <= $existingRating->rating ? '#FFD700' : '#ccc' }};">★</span>
                                    @endfor
                                    <p class="mb-0 mt-1" style="font-size: 13px;">{{ $existingRating->noidung }}</p>
                                </div>
                            @else
                               {{-- Form đánh giá --}}
                                <form action="{{ route('accounts.rate_product', $order->madh) }}" method="POST" class="mt-2 rating-form">
                                    @csrf
                                    <input type="hidden" name="mahd" value="{{ $order->madh }}">
                                    <input type="hidden" name="masp" value="{{ $ct->masp }}">

                                    <div class="star-rating mb-2" style="direction: rtl; display: inline-block;">
                                        @for($i=5; $i>=1; $i--)
                                            <input type="radio" id="star{{ $ct->masp }}-{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                            <label for="star{{ $ct->masp }}-{{ $i }}">★</label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <div class="text-danger" style="font-size: 13px;">{{ $message }}</div>
                                    @enderror

                                    <textarea name="noidung" class="form-control form-control-sm mb-2" rows="2" placeholder="Viết nhận xét...">{{ old('noidung') }}</textarea>
                                    @error('noidung')
                                        <div class="text-danger" style="font-size: 13px;">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn-rate">Gửi đánh giá</button>
                                </form>

                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <a href="{{ route('accounts.orders') }}" class="btn btn-outline-primary back-btn">
                ← Quay lại danh sách đơn hàng
            </a>

        </div>
    </div>
</div>

@endsection
