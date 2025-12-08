@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">

        {{-- HEADER --}}
        <div class="card-header text-white" style="background-color: #9a4b91ff;">
            <h4 class="mb-0">Sửa Nhà Cung Cấp</h4>
        </div>

        {{-- THÔNG BÁO LỖI --}}
        @if ($errors->any())
        <div class="alert alert-danger m-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- THÔNG BÁO THÀNH CÔNG --}}
        @if (session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
        @endif

        {{-- BODY --}}
        <div class="card-body" style="background-color: #f5f5f7;">

            <form action="{{ route('suppliers.update', $ncc->mancc) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- MÃ NCC (KHÔNG CHO SỬA) --}}
                <div class="mb-3">
                    <label class="form-label">Mã NCC</label>
                    <input type="text" value="{{ $ncc->mancc }}" class="form-control" disabled>
                </div>

                {{-- TÊN NCC --}}
                <div class="mb-3">
                    <label class="form-label">Tên NCC</label>
                    <input type="text" name="tenncc" class="form-control" value="{{ old('tenncc', $ncc->tenncc) }}" required>
                </div>

                {{-- SỐ ĐIỆN THOẠI --}}
                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="sdt" class="form-control" value="{{ old('sdt', $ncc->sdt) }}">
                </div>

                {{-- GMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Gmail</label>
                    <input type="email" name="gmail" class="form-control" value="{{ old('gmail', $ncc->gmail) }}">
                </div>

                {{-- ĐỊA CHỈ --}}
                <div class="mb-3">
                    <label class="form-label">Địa Chỉ</label>
                    <input type="text" name="diachi" class="form-control" value="{{ old('diachi', $ncc->diachi) }}">
                </div>

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Hủy</a>
            </form>

        </div>
    </div>
</div>
@endsection
