@extends('layouts.admin')

@section('title', 'Đăng nhập')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height:60vh;">
    <div class="card p-4" style="width:420px;">
        <h4 class="mb-3">Đăng nhập tài khoản</h4>

        {{-- Hiển thị session status --}}
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input id="password" type="password" name="password" required
                       class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                @endif

                <button class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>

        <hr class="my-3">

        <div class="text-center">
            Chưa có tài khoản?
            <a href="{{ route('register') }}">Đăng ký ngay</a>
        </div>
    </div>
</div>
@endsection
