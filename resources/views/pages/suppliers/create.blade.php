@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header text-white" style="background-color: #9a4b91ff;">
            Thêm Nhà Cung Cấp
        </div>
        <div class="card-body" style="background-color: #f5f5f7;">

            {{-- HIỂN THỊ LỖI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="mancc" class="form-label">Mã NCC</label>
                    <input type="text" name="mancc" id="mancc"
                           class="form-control"
                           value="{{ old('mancc') }}" required>
                    @error('mancc')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tenncc" class="form-label">Tên NCC</label>
                    <input type="text" name="tenncc" id="tenncc"
                           class="form-control"
                           value="{{ old('tenncc') }}" required>
                    @error('tenncc')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sdt" class="form-label">SĐT</label>
                    <input type="text" name="sdt" id="sdt"
                           class="form-control"
                           value="{{ old('sdt') }}">
                    @error('sdt')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gmail" class="form-label">Gmail</label>
                    <input type="email" name="gmail" id="gmail"
                           class="form-control"
                           value="{{ old('gmail') }}">
                    @error('gmail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="diachi" class="form-label">Địa Chỉ</label>
                    <input type="text" name="diachi" id="diachi"
                           class="form-control"
                           value="{{ old('diachi') }}">
                    @error('diachi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
