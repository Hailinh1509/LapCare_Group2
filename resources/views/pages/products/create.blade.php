@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header text-white" style="background-color:#9a4b91ff !important;">
            <h4 class="mb-0">Thêm Sản Phẩm</h4>
        </div>

        <div class="card-body">

            {{-- Hiển thị thông báo lỗi chung --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Lỗi xảy ra:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Mã SP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mã Sản Phẩm</label>
                        <input type="text" name="masp" class="form-control @error('masp') is-invalid @enderror"
                               value="{{ old('masp') }}" required>
                        @error('masp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                     {{-- Mã loại (maloaisp) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mã Loại Sản Phẩm</label>
                        <input type="text" name="maloaisp" class="form-control @error('maloaisp') is-invalid @enderror"
                               value="{{ old('maloaisp') }}" required>
                        @error('maloaisp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tên SP --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <input type="text" name="tensp" class="form-control @error('tensp') is-invalid @enderror"
                               value="{{ old('tensp') }}" required>
                        @error('tensp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Hình ảnh --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Hình Ảnh</label>
                        <input type="file" name="hinhanh" class="form-control @error('hinhanh') is-invalid @enderror" accept="image/*">
                        @error('hinhanh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Số lượng --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Số Lượng</label>
                        <input type="number" name="soluong" class="form-control @error('soluong') is-invalid @enderror"
                               value="{{ old('soluong') }}" required>
                        @error('soluong')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Giá --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giá (VNĐ)</label>
                        <input type="number" name="giasp" class="form-control @error('giasp') is-invalid @enderror"
                               value="{{ old('giasp') }}" required>
                        @error('giasp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Khuyến mãi --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Khuyến Mãi (%)</label>
                        <input type="number" name="khuyenmai" class="form-control @error('khuyenmai') is-invalid @enderror"
                               min="0" max="100" value="{{ old('khuyenmai', 0) }}">
                        @error('khuyenmai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Màn hình --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Màn Hình</label>
                        <input type="text" name="manhinh" class="form-control" value="{{ old('manhinh') }}">
                        @error('manhinh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- RAM --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">RAM</label>
                        <input type="text" name="ram" class="form-control" value="{{ old('ram') }}">
                        @error('ram')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- CPU --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">CPU</label>
                        <input type="text" name="cpu" class="form-control" value="{{ old('cpu') }}">
                        @error('cpu')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Ổ cứng --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ổ Cứng</label>
                        <input type="text" name="ocung" class="form-control" value="{{ old('ocung') }}">
                        @error('ocung')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Hãng --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hãng</label>
                        <input type="text" name="hang" class="form-control" value="{{ old('hang') }}">
                        @error('hang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Bảo hành --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Thời Gian Bảo Hành</label>
                        <input type="text" name="thoigian" class="form-control" value="{{ old('thoigian') }}">
                        @error('thoigian')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Mô Tả</label>
                        <textarea name="mota" class="form-control" rows="4">{{ old('mota') }}</textarea>
                        @error('mota')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Lưu Sản Phẩm</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay Lại</a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
