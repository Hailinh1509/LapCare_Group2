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

@include('partials.header')

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

<!-- ======= CHỌN THEO NHU CẦU (LOẠI SẢN PHẨM) ======= 
<div class="container mt-4">
    <h3 class="nhucau-title">Chọn theo nhu cầu</h3>

    <div class="nhucau-wrapper">
        {{-- Nếu controller gửi $loaisp, dùng nó; nếu không, fallback tĩnh --}}
        @php
            $topTypes = $loaisp ?? collect([
                (object)['maloaisp'=>'LT001','tenloaisp'=>'Văn phòng'],
                (object)['maloaisp'=>'LT002','tenloaisp'=>'Gaming'],
                (object)['maloaisp'=>'LT003','tenloaisp'=>'Đồ hoạ - Kỹ thuật'],
                (object)['maloaisp'=>'LT004','tenloaisp'=>'Sinh viên'],
                (object)['maloaisp'=>'LT005','tenloaisp'=>'Cảm ứng'],
                (object)['maloaisp'=>'LT006','tenloaisp'=>'Phụ kiện'],
            ]);
            $currentLoai = request('maloaisp');
        @endphp

        @foreach ($topTypes as $type)
            @php
                // support either object (from DB) or array
                $key = is_object($type) ? $type->maloaisp : ($type['maloaisp'] ?? '');
                $label = is_object($type) ? $type->tenloaisp : ($type['tenloaisp'] ?? '');
                $active = ($currentLoai == $key) ? 'active' : '';
                // build url keeping other filters
                $url = route('products.list', array_merge(request()->except('page'), ['maloaisp' => $key]));
            @endphp
            <a href="{{ $url }}" class="nhucau-item {{ $active }}">
                {{-- image mapping: bạn có thể đổi đường dẫn ảnh theo mã loại --}}
                <img src="{{ asset('images/' . ($key ?: 'default') . '.jpg') }}" onerror="this.src='{{ asset('images/default.jpg') }}'">
                <p>{{ $label }}</p>
            </a>
        @endforeach
    </div>
</div>
-->
{{-- LAYOUT 2 CỘT: LEFT FILTER + RIGHT CONTENT --}}
<div class="container mt-4">
    <h3 class="nhucau-title">Sản phẩm</h3>

    <div class="layout-wrapper">
        <!-- LEFT FILTER -->
        <aside class="left-filter">
            <h3 class="filter-title">
                <i class="fa fa-filter"></i> BỘ LỌC TÌM KIẾM
            </h3>
            <hr>

            <form id="filterForm" method="GET" action="{{ route('products.list') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">

                {{-- Nhu cầu / Loại sản phẩm (maloaisp[]) --}}
                <div class="filter-section">
                    <h4>Nhu cầu</h4>
                    <hr>
                    @foreach($loaisp ?? [] as $loai)
                        <label class="brand-item">
                            <input type="checkbox" name="maloaisp[]" value="{{ $loai->maloaisp }}"
                                   {{ in_array($loai->maloaisp, (array)request('maloaisp', [])) ? 'checked' : '' }}>
                            {{ $loai->tenloaisp }}
                        </label>
                    @endforeach
                </div>

                {{-- Khoảng giá --}}
                <div class="filter-section">
                    <h4>Khoảng Giá</h4>
                    <hr>
                    <input type="number" name="price_from" class="price-input" placeholder="Từ" value="{{ request('price_from') }}">
                    <input type="number" name="price_to" class="price-input" placeholder="Đến" value="{{ request('price_to') }}">
                </div>

                {{-- Thương hiệu --}}
                <div class="filter-section">
                    <h4>Thương hiệu</h4>
                    <hr>
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
                    <h4>RAM</h4>
                    <hr>
                    <div class="inline-options">
                        @foreach ($ramOptions as $r)
                            <label class="inline-item">
                                <input type="checkbox" name="ram[]" value="{{ $r }}"
                                       {{ in_array($r, (array)request('ram', [])) ? 'checked' : '' }}>
                                {{ $r }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Ổ cứng --}}
                <div class="filter-section">
                    <h4>Ổ cứng</h4>
                    <hr>
                    <div class="inline-options">
                        @foreach ($ocungOptions as $o)
                            <label class="inline-item">
                                <input type="checkbox" name="ocung[]" value="{{ $o }}"
                                       {{ in_array($o, (array)request('ocung', [])) ? 'checked' : '' }}>
                                {{ $o }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Màn hình --}}
                <div class="filter-section">
                    <h4>Màn hình</h4>
                    <hr>
                    @foreach ($manhinhOptions as $mh)
                        <label>
                            <input type="checkbox" name="manhinh[]" value="{{ $mh }}"
                                   {{ in_array($mh, (array)request('manhinh', [])) ? 'checked' : '' }}>
                            {{ $mh }}
                        </label>
                    @endforeach
                </div>

                {{-- Nút Áp dụng --}}
                <div class="filter-buttons">
                    <button type="submit" class="btn-apply-price btn-filter">Áp dụng</button>
                    <a href="{{ route('products.list') }}" class="btn-reset btn-filter">Xóa bộ lọc</a>
                </div>
            </form>
        </aside>

        <!-- RIGHT CONTENT -->
        <div class="right-content">
            <!-- Sort bar: dùng route giữ nguyên các params -->
            <div class="sort-bar">
                <span class="sort-label">Sắp xếp theo:</span>

                <a href="{{ route('products.list', array_merge(request()->except('page'), ['sort' => 'sale'])) }}" class="sort-btn">🔥 Khuyến mãi HOT</a>
                <a href="{{ route('products.list', array_merge(request()->except('page'), ['sort' => 'low'])) }}" class="sort-btn">Giá: Thấp → Cao</a>
                <a href="{{ route('products.list', array_merge(request()->except('page'), ['sort' => 'high'])) }}" class="sort-btn">Giá: Cao → Thấp</a>
            </div>

            <!-- Product grid -->
            <div class="product-grid">
                @if ($products->count() == 0)
                    <div class="no-product">🚫 Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</div>
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

                            <a href="{{ route('products.detail', $sp->masp) }}">
                                <img src="{{ asset($sp->hinhanh) }}" alt="">
                            </a>

                            <a href="{{ route('products.detail', $sp->masp) }}" style="text-decoration:none; color:inherit;">
                                <h5>{{ $sp->tensp }}</h5>
                            </a>

                            {{-- Hiển thị loại (nêu đã thiết lập quan hệ model) --}}
                            @if (method_exists($sp, 'loai') && $sp->loai)
                                <p class="brand">Loại: {{ $sp->loai->tenloaisp }}</p>
                            @else
                                <p class="brand">Hãng: {{ $sp->hang }}</p>
                            @endif

                            <p class="price">
                                {{ number_format($giagiam) }}đ
                                @if ($km > 0)
                                    <span class="old-price">{{ number_format($gia) }}đ</span>
                                @endif
                            </p>

<div class="btn-group">
    <a href="{{ route('buy.now', ['masp' => $sp->masp]) }}" class="btn-buy">
        Mua hàng
    </a>

@auth
    <a href="#"
       onclick="event.preventDefault(); document.getElementById('add-cart-{{ $sp->masp }}').submit();"
       class="btn-cart-icon">
        <i class="fa fa-shopping-cart"></i>
    </a>

    <!-- form ẩn để gửi request thêm giỏ -->
    <form id="add-cart-{{ $sp->masp }}" action="{{ route('cart.add') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="product_id" value="{{ $sp->masp }}">
        <input type="hidden" name="quantity" value="1">
    </form>
@else
    <a href="{{ route('login') }}" class="btn-cart-icon">
        <i class="fa fa-shopping-cart"></i>
    </a>
@endauth

</div>

                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if ($products->count() > 0)
                <div class="pagination-wrapper">
                    <div class="pagination">
                        @if ($products->currentPage() > 1)
                            <a href="{{ $products->previousPageUrl() }}">&laquo;</a>
                        @endif

                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <a href="{{ $products->url($i) }}" class="{{ $products->currentPage() == $i ? 'active' : '' }}">
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
</div> <!-- end container -->

@include('footer.footer')

<!-- Swiper JS + custom -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/products.js') }}"></script>

</body>
</html>
