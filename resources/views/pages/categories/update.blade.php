@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Sửa danh mục</h3>

    <form method="POST" action="{{ route('categories.update', $category->maloaisp) }}">
    @csrf
    @method('PUT')

        <div class="mb-3">
            <label>Mã loại sản phẩm:</label>
            <input type="text" value="{{ $category->maloaisp }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tên loại sản phẩm:</label>
            <input type="text" name="tenloaisp" class="form-control"
                   value="{{ $category->tenloaisp }}" required>
        </div>

        <button class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
