<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sản Phẩm</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>

@include('header.header')

<div class="container">

    <!-- ===================== BANNER ===================== -->
    <div class="swiper banner-slide">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('images/banner1.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('images/banner2.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('images/banner3.jpg') }}"></div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!--  -->
<script src="{{ asset('js/products.js') }}"></script>

<!---->
<div class="container">

    <h3 class="nhucau-title">Chọn theo nhu cầu</h3>

    <div class="nhucau-wrapper">
        @php
            $nc = [
                ["Văn phòng", "laptop văn phòng.jpg"],
                ["Gaming", "laptop gaming.jpg"],
                ["Đồ hoạ - Kỹ thuật", "laptop đồ hoạ kỹ thuật.jpg"],
                ["Sinh viên", "laptop sinh viên.jpg"],
                ["Cảm ứng", "laptop cảm ứng.jpg"],
                ["Phụ kiện", "phụ kiện.jpg"]
            ];
        @endphp

        @foreach ($nc as $item)
            <div class="nhucau-item">
                <img src="{{ asset('images/' . $item[1]) }}">
                <p>{{ $item[0] }}</p>
            </div>
        @endforeach
    </div>
          </div>
          

    <!-- ===================== FILTER TOP BAR ===================== 
    <div class="filter-topbar">
        <div class="filter-pill filter-open">
            <img src="{{ asset('images/filter-icon.png') }}" class="icon">
            <span>Lọc</span>
        </div>

        <div class="filter-pill"><img src="{{ asset('images/asus.png') }}" class="brand-icon"></div>
        <div class="filter-pill"><img src="{{ asset('images/hp.png') }}" class="brand-icon"></div>
        <div class="filter-pill"><img src="{{ asset('images/dell.png') }}" class="brand-icon"></div>
        <div class="filter-pill"><img src="{{ asset('images/lenovo.png') }}" class="brand-icon"></div>
    </div>

</div> 

-->
<!-- END container -->


<!-- ===================== POPUP FILTER ===================== 
<div id="filterModal" class="filter-modal">

    <div class="filter-modal-content">
        <div class="filter-modal-header">
            <h2>Tất cả bộ lọc</h2>
            <span class="filter-close">&times;</span>
        </div>

        <div class="filter-section">
            <h4>Hãng</h4>
            <div class="filter-grid">
                <label class="filter-option"><img src="{{ asset('images/hp.png') }}"></label>
                <label class="filter-option"><img src="{{ asset('images/asus.png') }}"></label>
                <label class="filter-option"><img src="{{ asset('images/acer.png') }}"></label>
                <label class="filter-option"><img src="{{ asset('images/lenovo.png') }}"></label>
                <label class="filter-option"><img src="{{ asset('images/dell.png') }}"></label>
                <label class="filter-option"><img src="{{ asset('images/msi.png') }}"></label>
            </div>

            <h4>Giá</h4>
            <div class="filter-grid">
                <div class="filter-price-btn">Dưới 10 triệu</div>
                <div class="filter-price-btn">10–15 triệu</div>
                <div class="filter-price-btn">15–20 triệu</div>
                <div class="filter-price-btn">20–25 triệu</div>
                <div class="filter-price-btn">25–30 triệu</div>
                <div class="filter-price-btn">Trên 30 triệu</div>
            </div>

        </div>

        <div class="filter-modal-footer">
            <button class="apply-btn">Áp dụng</button>
        </div>

    </div>

</div>
-->

<div class="container">

    <h3 class="nhucau-title">Sản phẩm</h3>

<!-- Bắt đầu layout 2 cột -->
<!-- LAYOUT WRAPPER (nằm ở vị trí bạn dùng trước đó) -->
<div class="layout-wrapper">

  <!-- LEFT FILTER -->
  <aside class="left-filter">
<h3 class="filter-title">
    <i class="fa fa-filter"></i> BỘ LỌC TÌM KIẾM
</h3>
<hr>


   
    <form id="filterForm" method="GET" action="{{ route('products.index') }}">
      {{-- Giữ các tham số sort + page nếu cần --}}
      <input type="hidden" name="sort" value="{{ request('sort') }}">

      {{-- Khoảng giá --}}
      <div class="filter-section">
        <h4>Khoảng Giá</h4> <hr>
        <input type="number" name="price_from" class="price-input" placeholder="Từ" value="{{ request('price_from') }}">
        <input type="number" name="price_to" class="price-input" placeholder="Đến" value="{{ request('price_to') }}">
      </div>

      {{-- Thương hiệu (có Xem thêm) --}}
<div class="filter-section">
    <h4>Thương hiệu</h4> <hr>

    <div class="brand-grid">
        @foreach($brands as $b)
            <label class="brand-item">
                <input type="checkbox" name="brand[]" value="{{ $b }}"
                       {{ in_array($b, (array)request('brand', [])) ? 'checked' : '' }}>
                {{ $b }}
            </label>
        @endforeach
    </div>

   
</div>


      {{-- RAM --}}
 <div class="filter-section">
    <h4>RAM</h4> <hr>
    <div class="inline-options">
        @foreach ($ramOptions as $ram)
            <label class="inline-item">
                <input type="checkbox" name="ram" value="{{ $ram }}"
                       {{ request('ram') == $ram ? 'checked' : '' }}>
                {{ $ram }}
            </label>
        @endforeach
    </div>
</div>


      {{-- Ổ cứng --}}
    <div class="filter-section">
    <h4>Ổ cứng</h4> <hr>
    <div class="inline-options">
        @foreach ($ocungOptions as $o)
            <label class="inline-item">
                <input type="checkbox" name="ocung" value="{{ $o }}"
                       {{ request('ocung') == $o ? 'checked' : '' }}>
                {{ $o }}
            </label>
        @endforeach
    </div>
</div>


      {{-- Màn hình --}}
      <div class="filter-section">
<h4>Màn hình</h4><hr>
@foreach ($manhinhOptions as $mh)
<label>
    <input type="checkbox" name="manhinh" value="{{ $mh }}"
        {{ request('manhinh') == $mh ? 'checked' : '' }}>
    {{ $mh }}
</label>
@endforeach

      </div>

      {{-- Nút Áp dụng --}}
<div class="filter-buttons">
    <button type="submit" class="btn-apply-price btn-filter">Áp dụng</button>
    <a href="{{ route('products.index') }}" class="btn-reset btn-filter">Xóa bộ lọc</a>
</div>


    </form>
  </aside>

  <!-- Cột phải: sort / products / pagination -->
  <div class="right-content">

    <!-- Hàng 1: Sắp xếp theo -->
    <div class="sort-bar">
      <span class="sort-label">Sắp xếp theo:</span>
      <a href="?sort=popular" class="sort-btn">Phổ biến</a>
      <a href="?sort=low" class="sort-btn">Giá: Thấp → Cao</a>
      <a href="?sort=high" class="sort-btn">Giá: Cao → Thấp</a>
      <a href="?sort=sale" class="sort-btn">🔥 Khuyến mãi HOT</a>
    </div>

    <!-- Hàng 2: Sản phẩm (grid) -->
    <div class="product-grid">
          @if ($products->count() == 0)
        <div class="no-product">
            🚫 Không tìm thấy sản phẩm nào phù hợp với bộ lọc.
        </div>
    @else
      @foreach ($products as $sp)
        @php
          $gia = $sp->giasp;
          $km = $sp->khuyenmai * 100;
          $giagiam = $gia - ($gia * ($km / 100));
        @endphp

        <div class="product-item">
          @if ($km > 0)
            <div class="discount-badge">Giảm {{ $km }}%</div>
          @endif

          <img src="{{ asset($sp->hinhanh) }}" alt="">
          <h5>{{ $sp->tensp }}</h5>
          <p class="brand">Hãng: {{ $sp->hang }}</p>

          <p class="price">
            {{ number_format($giagiam) }}đ
            @if ($km > 0)
              <span class="old-price">{{ number_format($gia) }}đ</span>
            @endif
          </p>

          <div class="btn-group">
            <button class="btn-buy">Mua hàng</button>
            <a href="/giohang/them/{{ $sp->masp }}" class="btn-cart-icon"><i class="fa fa-shopping-cart"></i></a>
          </div>
        </div>
      @endforeach
      @endif
    </div>

    <!-- HÀNG CUỐI: PHÂN TRANG (nằm dưới product-grid trong cùng cột phải) -->
@if ($products->count() > 0)
    <div class="pagination-wrapper">
        <div class="pagination">
            @if ($products->currentPage() > 1)
                <a href="{{ $products->previousPageUrl() }}">&laquo;</a>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <a href="{{ $products->url($i) }}" 
                   class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor

            @if ($products->currentPage() < $products->lastPage())
                <a href="{{ $products->nextPageUrl() }}">&raquo;</a>
            @endif
        </div>
    </div>
@endif


  </div> <!-- end right-content -->
</div> <!-- end layout-wrapper -->


</div>

@include('footer.footer')

</body>
</html>
