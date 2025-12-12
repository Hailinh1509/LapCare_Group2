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
.table th, .table td {
    text-align:center !important;
    vertical-align:middle !important;
}
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
</style>

<div class="container mt-4">

    <h3>Danh sách đơn nhập</h3>

{{-- THANH TÌM KIẾM --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <form action="{{ route('imports.search') }}" method="GET" class="flex-grow-1" style="max-width: 500px;">
        <div class="input-group">
            <input 
                type="text"
                name="keyword"
                class="form-control search-input"
                placeholder="Tìm theo mã đơn hoặc tên nhà cung cấp"
                value="{{ request('keyword') }}"
            >
            <button class="btn btn-primary">Tìm</button>
        </div>
    </form>

    <a href="{{ route('imports.index') }}" class="btn btn-secondary ms-3">Xem tất cả</a>
</div>


{{-- BẢNG ĐƠN NHẬP --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
{{-- THÔNG BÁO THÀNH CÔNG --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr>
            <th>Mã đơn</th>
            <th>Nhà cung cấp</th>
            <th>Ngày nhập</th>
            <th>Thành tiền</th>
            <th>Thanh toán</th>
            <th>Chi tiết</th>
        </tr>
    </thead>

    <tbody>
        @forelse($orders as $order)
        <tr>

            {{-- ✔ MÃ ĐƠN NHẬP --}}
            <td>{{ $order->madn }}</td>

            {{-- ✔ TÊN NHÀ CUNG CẤP --}}
            <td>{{ $order->ncc->tenncc ?? 'Không có' }}</td>

            {{-- ✔ NGÀY NHẬP --}}
            <td>{{ $order->ngaynhap }}</td>

            {{-- ✔ TỔNG TIỀN --}}
            <td>{{ number_format($order->tongtien ?? 0, 0, ',', '.') }} đ</td>

            {{-- ✔ THANH TOÁN --}}
            <td>
    <form action="{{ route('imports.updatePayment') }}" method="POST" class="d-flex gap-2">
        @csrf
 
        <input type="hidden" name="madn" value="{{ $order->madn }}">

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
            <button class="btn btn-success btn-sm">Cập nhật</button>
        @endif
    </form>
</td>



            {{-- ✔ LINK XEM CHI TIẾT --}}
            <td>
                <a href="{{ route('imports.detail', $order->madn) }}" class="btn btn-primary btn-sm">
                    Xem
                </a>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="7" class="text-center text-danger">Không có đơn nhập nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>

@endsection
