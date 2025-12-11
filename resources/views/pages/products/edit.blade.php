@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <h2>{{ $product->tensp }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->masp) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Cột trái: thông tin cơ bản và mô tả -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Mã SP</label>
                    <input type="text" class="form-control" value="{{ $product->masp }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Tên SP</label>
                    <input type="text" name="tensp" class="form-control" value="{{ old('tensp', $product->tensp) }}">
                </div>

                <div class="mb-3">
                    <label>Loại Sản Phẩm</label>
                    <select name="maloaisp" class="form-control">
                        @foreach($loaisp as $loai)
                            <option value="{{ $loai->maloaisp }}"
                                {{ $product->maloaisp == $loai->maloaisp ? 'selected' : '' }}>
                                {{ $loai->tenloaisp }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Số Lượng</label>
                    <input type="number" name="soluong" class="form-control" value="{{ old('soluong', $product->soluong) }}">
                </div>

                <div class="mb-3">
                    <label>Giá SP</label>
                    <input type="text" name="giasp" class="form-control" value="{{ old('giasp', $product->giasp) }}">
                </div>

                <div class="mb-3">
                    <label>Khuyến Mãi (%)</label>
                    <input type="text" name="khuyenmai" class="form-control" value="{{ old('khuyenmai', $product->khuyenmai) }}">
                </div>

                <div class="mb-3">
                    <label>Mô Tả</label>
                    <textarea name="mota" class="form-control" rows="6">{{ old('mota', $product->mota) }}</textarea>
                </div>
            </div>

            <!-- Cột phải: các thông số kỹ thuật -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Màn Hình</label>
                    <input type="text" name="manhinh" class="form-control" value="{{ old('manhinh', $product->manhinh) }}">
                </div>

                <div class="mb-3">
                    <label>RAM</label>
                    <input type="text" name="ram" class="form-control" value="{{ old('ram', $product->ram) }}">
                </div>

                <div class="mb-3">
                    <label>CPU</label>
                    <input type="text" name="cpu" class="form-control" value="{{ old('cpu', $product->cpu) }}">
                </div>

                <div class="mb-3">
                    <label>Ổ Cứng</label>
                    <input type="text" name="ocung" class="form-control" value="{{ old('ocung', $product->ocung) }}">
                </div>

                <div class="mb-3">
                    <label>Hãng</label>
                    <input type="text" name="hang" class="form-control" value="{{ old('hang', $product->hang) }}">
                </div>

                <div class="mb-3">
                    <label>Thời Gian BH</label>
                    <input type="text" name="thoigian" class="form-control" value="{{ old('thoigian', $product->thoigian) }}">
                </div>

                <div class="mb-3">
                    <label>Hình Ảnh</label>
                    @if($product->hinhanh)
                        <div class="mb-2">
                            <img src="{{ asset($product->hinhanh) }}" width="150" alt="Ảnh SP">
                        </div>
                    @endif
                    <input type="file" name="hinhanh" class="form-control">
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Cập Nhật Sản Phẩm</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
@endsection
