@extends('layouts.admin')

@section('content')
<style>
    .product-table thead th {
        background-color: #1101c8ff !important;
        color: white !important;
        text-align: center;
        font-size: 15px;
    }

    .order-table td,
    .order-table th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    .product-col {
        text-align: center !important;
    }

    .product-img {
        width: 70px;
        height: auto;
        margin-right: 10px;
    }

    .order-header th {
        background-color: #1101c8ff !important;
        color: #fff !important;
    }
</style>

<div class="container mt-4">

    <h3 class="mb-4">Chi tiết đơn hàng #{{ $order->madh }}</h3>

    {{-- ================== THÔNG TIN KHÁCH HÀNG ================== --}}
    <div class="row mb-4">

        <div class="col-md-8">
            <div class="card p-3 h-100">
                <h5><strong>📦 Thông tin nhận hàng</strong></h5>

                <p><strong>Người nhận:</strong> {{ $order->user->name ?? 'Không có' }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->user->sdt ?? 'Không có' }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->diachigiaohang }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->ngaydat }}</p>
            </div>
        </div>

        {{-- ================== HÌNH THỨC THANH TOÁN ================== --}}
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <h5><strong>💳 Hình thức thanh toán</strong></h5>
                <p>{{ $order->pttt }}</p>

                <strong>Trạng thái thanh toán:</strong>
                @if($order->ttthanhtoan == 'đã thanh toán')
                    <span class="badge bg-success w-100 p-2 mt-2 text-center">Đã thanh toán</span>
                @else
                    <span class="badge bg-danger w-100 p-2 mt-2 text-center">Chưa thanh toán</span>
                @endif
            </div>
        </div>

    </div>

{{-- ... phần header, thông tin người nhận như trước ... --}}

{{-- BẢNG SẢN PHẨM --}}
<div class="card mb-4 p-3">
    <h5><strong>🛒 Sản phẩm</strong></h5>

    <table class="table table-bordered order-table">
        <thead class="order-header">
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
            <tr>
                <td>
                    @if(isset($item->product))
                        <img src="/{{ $item->product->hinhanh }}" class="product-img" alt="">
                        {{ $item->product->tensp }}
                    @else
                        {{-- nếu không có relation product, hiển thị masp --}}
                        {{ $item->masp }}
                    @endif
                </td>
                <td>{{ $item->soluong }}</td>
                <td>{{ number_format((float)$item->dongia, 0, ',', '.') }}đ</td>
                <td>{{ number_format((float)$item->soluong * (float)$item->dongia, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- TỔNG KẾT (không hiện "Tạm tính" theo yêu cầu) --}}
<div class="card p-3 mb-4">
    <h5><strong>📄 Tổng kết đơn hàng</strong></h5>

<table class="table mt-2">

    <tr>
        <td width="250"><strong>VAT:</strong></td>
        <td>- {{ number_format($vat, 0, ',', '.') }} đ</td>
    </tr>

    <tr>
        <td><strong>Phí vận chuyển:</strong></td>
        <td>- {{ number_format($ship, 0, ',', '.') }} đ</td>
    </tr>

    <tr class="table-primary">
        <td><strong>Thành tiền:</strong></td>
        <td>
            <strong style="font-size:18px; color:#000;">
                {{ number_format($thanhtien, 0, ',', '.') }} đ
            </strong>
        </td>
    </tr>

    @if(!empty($order->ghichu))
    <tr>
        <td><strong>Ghi chú:</strong></td>
        <td>{{ $order->ghichu }}</td>
    </tr>
    @endif
</table>

</div>



    <div class="text-start mt-3 mb-5">
        <a href="{{ route('orders.index') }}" class="btn btn-warning">
            ← Về danh sách đơn hàng
        </a>
    </div>

</div>

@endsection
