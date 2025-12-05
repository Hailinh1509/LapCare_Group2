@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-primary text-white" style="background-color: #9a4b91ff !important;;">
            <h4 class="mb-0">Thông Tin Sản Phẩm</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Mã SP + Tên SP -->
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Mã Sản Phẩm</label>
                        <input type="text" name="masp" class="form-control" required>
                    </div>

                    <div class="col-md-10 mb-3">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <input type="text" name="tensp" class="form-control" required>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Hình Ảnh</label>
                        <input type="file" name="hinhanh" class="form-control">
                    </div>

                    <!-- Số lượng -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Số Lượng</label>
                        <input type="number" name="soluong" class="form-control" required>
                    </div>

                    <!-- Giá -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="giasp" class="form-control" required>
                    </div>

                    <!-- Khuyến mãi -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Khuyến Mãi (%)</label>
                        <input type="number" name="khuyenmai" class="form-control">
                    </div>

                    <!-- Màn hình -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Màn Hình</label>
                        <input type="text" name="manhinh" class="form-control">
                    </div>

                    <!-- RAM -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">RAM</label>
                        <input type="text" name="ram" class="form-control">
                    </div>

                    <!-- CPU -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">CPU</label>
                        <input type="text" name="cpu" class="form-control">
                    </div>

                    <!-- Ổ cứng -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ổ Cứng</label>
                        <input type="text" name="ocung" class="form-control">
                    </div>

                    <!-- Hãng -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hãng</label>
                        <input type="text" name="hang" class="form-control">
                    </div>

                    <!-- Thời gian bảo hành -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Thời Gian Bảo Hành</label>
                        <input type="text" name="thoigian" class="form-control">
                    </div>

                    <!-- Mô tả -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Mô Tả</label>
                        <textarea name="mota" class="form-control" rows="4"></textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-success">Lưu Sản Phẩm</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
