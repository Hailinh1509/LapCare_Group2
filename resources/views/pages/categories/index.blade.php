{{--Khai báo kế thừa layout, giống như "template cha".--}}
@extends('layouts.admin')

@section('content')
    <h3>Tất cả danh mục</h3>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- THANH TÌM KIẾM --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('categories.search') }}" method="POST" class="d-flex">
    @csrf
    <input type="text" name="keyword" class="form-control"
           placeholder="Tìm Kiếm Theo Tên">
    <button type="submit" class="btn btn-primary ms-2">Tìm
        <!--<i class="fas fa-search"></i>-->
    </button>
</form>
</div>

<table class="table table-hover align-middle">
    <thead class="tablehead" style="font-size:16px; font-weight:bold; background:#1101c8 !important; color:white !important;">
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
                <td><a href="#" 
                   class="btn btn-success btn-sm me-1">
                    <i class="bi bi-pencil-fill"></i>
                </a></td>
            </tr>
            @endforeach
        </tbody>
</table>
@endsection
