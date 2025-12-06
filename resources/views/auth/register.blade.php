<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f3eaff, #eaddff); /* pastel rất nhạt */
            height: 100vh;
        }
        .register-card {
            width: 450px;
            border-radius: 20px;
            padding: 35px;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            animation: fadeIn .5s ease;
        }
        .form-control {
            padding-left: 42px;
            height: 48px;
            border-radius: 12px;
            border: 1px solid #e3d8ff; /* tím pastel nhạt */
        }
        .input-icon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #b6a2e8;  /* tím pastel nhạt */
        }
        .btn-gradient {
            background: linear-gradient(135deg, #e3d3ff, #d7c7ff); /* nút tím nhạt */
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            color: #4a3c61;
            width: 100%;
            transition: 0.2s;
        }
        .btn-gradient:hover {
            filter: brightness(0.95);
        }
        .title {
            font-weight: 700;
            font-size: 26px;
            text-align: center;
            margin-bottom: 20px;
            color: #5a4c75;
        }
        a {
            color: #8e7ac9;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="register-card">

        <div class="title">Tạo tài khoản</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3 position-relative">
                <i class="input-icon bi bi-person"></i>
                <input name="name" type="text" value="{{ old('name') }}" required
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Họ và tên">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3 position-relative">
                <i class="input-icon bi bi-envelope"></i>
                <input name="email" type="email" value="{{ old('email') }}" required
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="Email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3 position-relative">
                <i class="input-icon bi bi-lock"></i>
                <input name="password" type="password" required
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Mật khẩu">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Confirm password --}}
            <div class="mb-3 position-relative">
                <i class="input-icon bi bi-lock-fill"></i>
                <input name="password_confirmation" type="password" required
                       class="form-control"
                       placeholder="Xác nhận mật khẩu">
            </div>

            {{-- Button --}}
            <button class="btn-gradient mt-2">Đăng ký</button>

        </form>

        <div class="text-center mt-3">
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>

    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</body>
</html>
