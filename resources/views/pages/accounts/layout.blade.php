<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Tài khoản')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

  <style>
  .account-sidebar { width: 100%;  }
  .account-sidebar .list-group { margin: 0; border-radius: 8px; overflow: hidden; }
  .account-sidebar .list-group-item {
    background: white;
    color: black;
    padding: 14px 16px;
    border: none;
    border-left: 6px solid transparent;
  }

  .account-sidebar .list-group-item.active {
  background: #4B0082; /* màu nền mục hiện tại */
  color: #fff;          /* chữ trắng nổi bật */
  border-left-color: #a9d3f7ff; /* viền bên trái */
}

  .account-sidebar .list-group-item:hover {
    background: white;
    color: #690505ff;
    font-weight: bold;
  }

  .account-card { width: 100%; padding: 10px; }

  .account-sidebar-sticky { 
    position: sticky; 
    top: 100px; 
  }

  /* wrapper chính */
  .account-main-wrapper { 
    max-width: 1200px; /* giới hạn chiều rộng */
    margin: 30px auto 20px auto; /* cách header 100px, tự động căn giữa */
    padding: 0 20px; /* padding 2 bên cho khoảng trống thêm */
  }

  .account-wrapper-row { align-items: flex-start; }
</style>

</head>
<body>
  @include('partials.header')

  <div class="account-main-wrapper">
    <div class="row account-wrapper-row g-1">
      <div class="col-md-3">
        <div class="account-sidebar account-sidebar-sticky">
          @include('pages.accounts.sidebar')
        </div>
      </div>

      <div class="col-md-9">
        <div class="account-card card p-3">
          @yield('account-content')
        </div>
      </div>
    </div>
  </div>

  @include('footer.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  @yield('scripts')

</body>
</html>
