<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đặt hàng thành công - LapCare</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
</head>
<body class="bg-light">
  @include('partials.header')

  <div class="container py-5">
    <div class="card p-4 shadow-sm">
      <h4 class="mb-2">Cảm ơn bạn đã đặt hàng!</h4>
      <p class="mb-0">
        {{ session('success') ?? 'Đơn hàng của bạn đã được ghi nhận. Vui lòng chờ hệ thống xác nhận giao dịch.' }}
      </p>

      <div class="mt-3 d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-primary">Về trang chủ</a>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">Xem giỏ hàng</a>
      </div>
    </div>
  </div>

  @include('footer.footer')
</body>
</html>
