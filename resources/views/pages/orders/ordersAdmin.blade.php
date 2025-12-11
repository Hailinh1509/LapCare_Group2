@extends('layouts.admin')

@section('content')

<style>
.table thead th {
    background-color: #1101c8ff !important;
    color: white !important;
    text-align: center !important;
    font-size: 16px !important; 
}
.badge-status {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}
.badge-unpaid { color:#d9534f;border:2px solid #d9534f;background:#ffe5e5; }
.badge-paid { color:#4CAF50;border:2px solid #4CAF50;background:#e7ffe7; }
.badge-shipping-no { color:#d9534f;border:2px solid #d9534f;background:#ffe5e5; }
.badge-shipping-yes { color:#4CAF50;border:2px solid #4CAF50;background:#e7ffe7; }

.table th, .table td {
    text-align:center !important;
    vertical-align:middle !important;
}
/* Thanh tìm kiếm dài + màu nhạt + chữ nhỏ */
.search-input {
    height: 42px;
    font-size: 14px;
    background-color: #fffcfcff;
    border-radius: 6px;
}

.search-input::placeholder {
    color: #999;
    font-size: 13px;
}

.btn-primary {
    background-color: #1101c8ff;
    border: none;
}
.btn-update-sm {
    padding: 3px 10px;      /* thu nhỏ nút */
    font-size: 12px;        /* chữ nhỏ lại */
    line-height: 1;         /* giảm chiều cao */
    border-radius: 6px;     /* bo nhẹ đẹp */
}


</style>

<div class="container mt-4">

    <h3>Danh sách đơn hàng</h3>

 {{-- THANH TÌM KIẾM --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <form action="{{ route('orders.search') }}" method="GET" class="flex-grow-1" style="max-width: 500px;">
        <div class="input-group">
            <input 
                type="text"
                name="keyword"
                class="form-control search-input"
                placeholder="Tìm theo mã đơn hoặc tên khách"
                value="{{ request('keyword') }}"
            >
            <button class="btn btn-primary">Tìm</button>
        </div>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-3">
        Xem tất cả
    </a>
</div>


    {{-- BẢNG ĐƠN HÀNG --}}
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Tên khách hàng</th>
                <th>Ngày đặt</th>
                <th>Thành tiền</th>
                <th>Thanh toán</th>
                <th>Vận chuyển</th>
                <th>Chi tiết</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->madh }}</td>
                <td>{{ $order->user->name ?? 'Không có' }}</td>
                <td>{{ $order->ngaydat }}</td>

                <td>{{ number_format($order->tongtien ?? 0, 0, ',', '.') }}đ</td>

                {{-- ✔ THANH TOÁN --}}
<td>
    <form action="{{ route('orders.updatePayment') }}" method="POST"
          class="d-flex align-items-center gap-2">
        @csrf

        <input type="hidden" name="madh" value="{{ $order->madh }}">

        <select name="ttthanhtoan" class="form-select form-select-sm"
                {{ $order->ttthanhtoan == 'đã thanh toán' ? 'disabled' : '' }}>
            <option value="chưa thanh toán"
                {{ $order->ttthanhtoan == 'chưa thanh toán' ? 'selected' : '' }}>
                Chưa thanh toán
            </option>

            <option value="đã thanh toán"
                {{ $order->ttthanhtoan == 'đã thanh toán' ? 'selected' : '' }}>
                Đã thanh toán
            </option>
        </select>

        @if($order->ttthanhtoan != 'đã thanh toán')
            <button class="btn btn-success btn-update-sm">Cập nhật</button>

        @endif
    </form>
</td>


{{-- ✔ VẬN CHUYỂN --}}
<td>
    <form action="{{ route('orders.updateShipping') }}" method="POST"
          class="d-flex align-items-center gap-2">
        @csrf

        <input type="hidden" name="madh" value="{{ $order->madh }}">

        <select name="ttvanchuyen" class="form-select form-select-sm"
                {{ $order->ttvanchuyen == 'đã giao hàng' ? 'disabled' : '' }}>

            <option value="đang xử lý"
                {{ $order->ttvanchuyen == 'đang xử lý' ? 'selected' : '' }}>
                Đang xử lý
            </option>

            <option value="đang giao"
                {{ $order->ttvanchuyen == 'đang giao' ? 'selected' : '' }}>
                Đang giao
            </option>

            <option value="đã giao hàng"
                {{ $order->ttvanchuyen == 'đã giao hàng' ? 'selected' : '' }}>
                Đã giao hàng
            </option>

        </select>

        @if($order->ttvanchuyen != 'đã giao hàng')
            <button class="btn btn-success btn-update-sm">Cập nhật</button>

        @endif
    </form>
</td>




                <td>
                    <a href="{{ route('orders.detail', $order->madh) }}" class="btn btn-primary btn-sm">
                        Xem
                    </a>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="7" class="text-center text-danger">Không có đơn hàng nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
