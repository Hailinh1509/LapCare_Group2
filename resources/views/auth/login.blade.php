<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3e8ff; /* tím pastel rất nhạt */
        }

        .card-custom {
            border-radius: 18px;
            background: #ffffff;
            padding: 28px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

        /* NÚT TÍM ĐỒNG BỘ */
        .btn-purple {
            background-color: #7c3aed !important; 
            border-color: #7c3aed !important;
            color: white !important;
            border-radius: 10px;
            transition: 0.2s;
        }

        .btn-purple:hover {
            background-color: #6d28d9 !important;
            border-color: #6d28d9 !important;
        }

        a {
            color: #6d28d9;
            text-decoration: none;
        }

        a:hover {
            color: #5b21b6;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">

        <div class="card card-custom" style="width:420px;">

            <h4 class="mb-3 text-center fw-semibold">Đăng nhập tài khoản</h4>

            {{-- Thông báo thành công --}}
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input id="password" type="password" name="password" required
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="mb-3 form-check">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                </div>

                {{-- Nút --}}
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                    @endif

                    <button class="btn btn-purple px-4">Đăng nhập</button>
                </div>
            </form>

            <hr class="my-3">

            <div class="text-center">
                Chưa có tài khoản?
                <a href="{{ route('register') }}">Đăng ký ngay</a>
            </div>

        </div>
    </div>

</body>
</html>
