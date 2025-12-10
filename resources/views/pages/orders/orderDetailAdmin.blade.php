@extends('layouts.admin')

@section('content')
<style>
    /* Màu nền header bảng sản phẩm */
    .product-table thead th {
        background-color: #1101c8ff !important;
        color: white !important;
        text-align: center;
        font-size: 15px;
    }

    .product-table td {
        vertical-align: middle;
        font-size: 14px;
    }
    /* Căn giữa toàn bộ nội dung các ô */
    .order-table td,
    .order-table th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    /* Riêng cột sản phẩm muốn căn trái thì bỏ dòng dưới */
    .product-col {
        text-align: center !important;
    }

    /* Ảnh sản phẩm đẹp hơn */
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
{{-- ============ HÀNG 1: Thông tin nhận hàng + Hình thức thanh toán ============ --}}
<div class="row mb-4">

    {{-- CỘT 1: THÔNG TIN NHẬN HÀNG (70%) --}}
    <div class="col-md-8">
        <div class="card p-3 h-100">
            <h5><strong>📦 Thông tin nhận hàng</strong></h5>

            <p><strong>Người nhận:</strong> {{ $order->user->name ?? 'Không có' }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->user->sdt ?? 'Không có' }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->diachigiaohang }}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->ngaydat }}</p>
        </div>
    </div>

    {{-- CỘT 2: HÌNH THỨC THANH TOÁN (30%) --}}
    <div class="col-md-4">
        <div class="card p-3 h-100">
            <h5><strong>💳 Hình thức thanh toán</strong></h5>
            <p>{{ $order->pttt }}</p>

            <strong>Trạng thái thanh toán:</strong>
            @if($order->ttthanhtoan == 'Đã thanh toán')
                <span class="badge bg-success w-100 p-2 mt-2 text-center">Đã thanh toán</span>
            @else
                <span class="badge bg-danger w-100 p-2 mt-2 text-center">Chưa thanh toán</span>
            @endif
        </div>
    </div>

</div>
{{-- ================== DANH SÁCH SẢN PHẨM ================== --}}
<div class="card mb-4 p-3">
    <h5><strong>🛒 Sản phẩm</strong></h5>

<table class="table table-bordered order-table">
    <thead class="order-header">
        <tr>
            <th class="product-col">Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $item)
        <tr>
            <td class="product-col">
                <img src="/{{ $item->product->hinhanh }}" class="product-img">
                {{ $item->product->tensp }}
            </td>
            <td>{{ $item->soluong }}</td>
            <td>{{ number_format($item->dongia, 0, ',', '.') }}đ</td>
            <td>{{ number_format($item->soluong * $item->dongia, 0, ',', '.') }}đ</td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
<div class="text-start mt-3 mb-5">
    <a href="{{ route('orders.index') }}" class="btn btn-warning">
        ← Về danh sách đơn hàng
    </a>
</div>

@endsection
