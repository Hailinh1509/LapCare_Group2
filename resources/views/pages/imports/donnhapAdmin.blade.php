@extends('layouts.admin')

@section('content')
<style>
.table thead th {
    background-color: #1101c8ff !important;
    color: white !important;
    text-align: center !important;
}
.table td { text-align:center; }
.badge-paid { background:#d4ffe1; color:#1e9e43; padding:6px 12px; border-radius:12px; }
.badge-unpaid { background:#ffe3e3; color:#d92b2b; padding:6px 12px; border-radius:12px; }
</style>

<div class="container mt-4">
    <h3>Danh sách đơn nhập</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Mã đơn nhập</th>
                <th>Nhà cung cấp</th>
                <th>Ngày nhập</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Chi tiết</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($imports as $item)
            <tr>
                <td>{{ $item->madn }}</td>
                <td>{{ $item->ncc->tenncc ?? 'Không có' }}</td>
                <td>{{ $item->ngaynhap }}</td>
                <td>{{ number_format($item->tongtien, 0, ',', '.') }}đ</td>

                <td>
                    @if($item->ttthanhtoan == 'đã thanh toán')
                        <span class="badge-paid">Đã thanh toán</span>
                    @else
                        <span class="badge-unpaid">Chưa thanh toán</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('imports.detail', $item->madn) }}" class="btn btn-primary btn-sm">
                        Xem
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
