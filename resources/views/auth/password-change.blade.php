<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3e8ff; /* tím pastel */
        }

        .card-custom {
            border-radius: 18px;
            background: #ffffff;
            padding: 28px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

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
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">

        <div class="card card-custom" style="width:420px;">

            <h4 class="mb-3 text-center fw-semibold">Đổi mật khẩu</h4>

            {{-- Thông báo --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.change.submit') }}">
                @csrf

                {{-- Mật khẩu cũ --}}
                <div class="mb-3">
                    <label class="form-label">Mật khẩu cũ</label>
                    <input type="password" name="old_password"
                           class="form-control @error('old_password') is-invalid @enderror">
                    @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mật khẩu mới --}}
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="new_password"
                           class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <button class="btn btn-purple w-100">Cập nhật mật khẩu</button>
            </form>

            <hr class="my-3">

            <div class="text-center">
                <a href="{{ route('accounts.index') }}">← Quay lại tài khoản</a>
            </div>

        </div>

    </div>

</body>
</html>
