<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>LapCare - Trang chủ</title>
</head>
<body>
    <h1>Chào mừng đến LapCare</h1>
    <p>Website bán laptop và phụ kiện</p>

    <hr>

    @auth
        <p>Xin chào, {{ auth()->user()->name }}!</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
    @else
        <a href="{{ route('login') }}">Đăng nhập</a> |
        <a href="{{ route('register') }}">Đăng ký</a>
    @endauth
</body>
</html>
