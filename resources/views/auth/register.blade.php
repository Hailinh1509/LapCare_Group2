@extends('layouts.admin')

@section('title', 'Đăng ký')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height:60vh;">
    <div class="card p-4" style="width:520px;">
        <h4 class="mb-3">Tạo tài khoản mới</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input name="name" type="text" value="{{ old('name') }}" required
                       class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required
                       class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input name="password" type="password" required
                       class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Xác nhận mật khẩu</label>
                <input name="password_confirmation" type="password" required class="form-control">
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Đăng ký</button>
            </div>
        </form>

        <hr class="my-3">

        <div class="text-center">
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</div>
@endsection
