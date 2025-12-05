@extends('layouts.admin')
@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm danh mục sản phẩm</h4>
        </div>

        <div class="card-body">

            {{-- Hiển thị lỗi validate --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                {{-- Mã loại sản phẩm --}}
                <div class="mb-3">
                    <label class="form-label">Mã loại sản phẩm</label>
                    <input 
                        type="text" 
                        name="maloaisp" 
                        class="form-control @error('maloaisp') is-invalid @enderror"
                        placeholder="Nhập mã loại (VD: LP001)"
                        value="{{ old('maloaisp') }}"
                    >
                    @error('maloaisp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tên loại sản phẩm --}}
                <div class="mb-3">
                    <label class="form-label">Tên loại sản phẩm</label>
                    <input 
                        type="text" 
                        name="tenloaisp" 
                        class="form-control @error('tenloaisp') is-invalid @enderror"
                        placeholder="Nhập tên loại sản phẩm"
                        value="{{ old('tenloaisp') }}"
                    >
                    @error('tenloaisp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nút submit --}}
                <div class="text-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
