@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h3>Chi tiết đơn nhập #{{ $import->madn }}</h3>

    <div class="card p-3 mb-4">
        <p><strong>Nhà cung cấp:</strong> {{ $import->ncc->tenncc }}</p>
        <p><strong>Ngày nhập:</strong> {{ $import->ngaynhap }}</p>
        <p><strong>Trạng thái thanh toán:</strong> 
            @if($import->ttthanhtoan == 'đã thanh toán')
                <span class="badge btn-success p-2">Đã thanh toán</span>
            @else
                <span class="badge btn-danger p-2">Chưa thanh toán</span>
            @endif
        </p>
        <p><strong>Tổng tiền:</strong> {{ number_format($import->tongtien, 0, ',', '.') }}đ</p>
    </div>

    <h5><strong>Sản phẩm nhập</strong></h5>

    <table class="table table-bordered">
        <thead style="background:#1101c8ff;color:white;">
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Thành tiền</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($details as $d)
            <tr>
                <td>{{ $d->product->tensp ?? 'Sản phẩm bị xóa' }}</td>
                <td>{{ $d->soluong }}</td>
                <td>{{ number_format($d->gianhap, 0, ',', '.') }}đ</td>
                <td>{{ number_format($d->soluong * $d->gianhap, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
