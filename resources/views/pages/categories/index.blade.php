{{--Khai báo kế thừa layout, giống như "template cha".--}}
@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .table thead th {
        background-color: #851978ff !important;
        color: white !important;
        text-align: center !important;
        font-size: 16px !important; 
    }
</style>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Tất cả danh mục</h3>
    </div>
    {{-- THANH TÌM KIẾM --}}
<div class="d-flex justify-content-between align-items-center mb-3">
<form action="{{ route('categories.search') }}" method="GET" class="d-flex mb-4" style="max-width: 380px;">
        <input type="text" name="keyword" class="form-control"
               placeholder="Tìm kiếm theo tên" required
               style="border-radius: 8px 0 0 8px;">

        <button type="submit" class="btn btn-primary"
                style="
                    background:#4c3cf1;
                    border:none;
                    padding: 8px 18px;
                    border-radius:0 8px 8px 0;
                ">
            Tìm
        </button>
    </form>

</div>
<table class="table table-bordered table-striped">
    <thead class="tablehead">
            <tr>
                <th>Mã loại sản phẩm</th>
                <th>Tên mã loại sản phẩm</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
                <th>Số lượng sản phẩm</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody style="font-size: 15px;">
            
            @foreach ($categories as $item)
            <tr>
                <td>{{ $item->maloaisp }}</td>
                <td>{{ $item->tenloaisp }}</td>
                <td>{{ $item->ngaytao }}</td>
                <td>{{ $item->ngaysua }}</td>
                <td>{{ $item->soluong_sanpham }}</td>
                <td class="text-center">
                    <a href="{{ route('categories.edit', $item->maloaisp) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
            @if ($categories->isEmpty())
            <tr>
                <td colspan="7" class="text-center text-danger">Không tìm thấy dữ liệu.</td>
            </tr>
            @endif
            @endforeach
        </tbody>
</table>
</div>
@endsection
