<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>

    <!-- Bootstrap để hiển thị đẹp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <style>
.page-btn{
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid red;
    border-radius: 6px; /* Nếu muốn vuông bo góc nhẹ */
    cursor: pointer;

}

</style>
</head>
<body>

    <div class="container mt-5">

        <div class="row">

            <!-- Hình ảnh -->
            <div class="col-md-6 text-center">
                <img src="{{ asset($product->hinhanh) }}" class="img-fluid" alt="Hình sản phẩm" style="border: 5px solid black; ">

            </div>

            <!-- Thông tin -->
            <div class="col-md-6">
                <h2>{{ $product->tensp }}</h2>

                <p class="text-muted">{!! nl2br(e($product->mota)) !!}</p>

                @php
                    $gia = (float)$product->giasp;
                    $km = (float)$product->khuyenmai;
                    $gia_km = $km > 0 ? $gia * (1 - $km) : $gia;
                @endphp

                <!-- Giá khuyến mãi -->
                <p class="fs-3 fw-bold text-danger">
                    {{ number_format($gia_km, 0, ',', '.') }} đ
                </p>

                <!-- Giá gốc nếu có giảm -->
                @if ($km > 0)
                <p class="text-decoration-line-through text-muted">
                    {{ number_format($gia, 0, ',', '.') }} đ
                </p>
                @endif
                <H3>Thông Số Kỹ Thuật</H3>
                <ul >
                    @if ($product->cpu)
                        <li><strong>CPU:</strong> {{ $product->cpu }}</li>
                    @endif
                    @if ($product->ram)
                        <li><strong>RAM:</strong> {{ $product->ram }}</li>
                    @endif
                    @if ($product->ocung)
                        <li><strong>Ổ cứng:</strong> {{ $product->ocung }}</li>
                    @endif
                    @if ($product->manhinh)
                        <li><strong>Màn hình:</strong> {{ $product->manhinh }}</li>
                    @endif
                    <li><strong>Hãng:</strong> {{ $product->hang }}</li>
                    <li><strong>Thời gian bảo hành:</strong> {{ $product->thoigian }}</li>
                </ul>
            

                <!-- Chọn số lượng -->
                <div class="mb-3">
                <label for="qty" class="form-label">Số lượng:</label>
                <input type="number" id="qty" name="quantity" class="form-control w-25" min="1" value="1">
                 </div>
            <div class="card-button" style="display:flex; gap:15px; padding:20px;">
                <!-- Thêm vào giỏ -->
                <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                     @csrf
                    <input type="hidden" name="product_id" value="{{ $product->masp }}">
                    <input type="hidden" id="cart_qty" name="quantity">
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ</button>
                </form>

                <!-- Mua ngay -->
                <form action="{{ route('buy.now') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->masp }}">
                    <input type="hidden" id="buy_qty" name="quantity">
                    <button type="submit" class="btn btn-danger">Mua ngay</button>
                </form>
            </div>
            </div> <!-- end col-md-6 -->
            
        </div> <!-- end row -->
    <!-- Phần content-container -->
<div class="content-container">
    <h3>{{ $product->tensp }} – thiết bị được thiết kế để định hình lại cách bạn làm việc, học tập và giải trí.</h3>

    <p>
        Với bộ xử lý hiệu năng cao cùng bộ nhớ RAM dung lượng lớn, 
        <strong>{{ $product->tensp }}</strong> không chỉ đáp ứng mà còn vượt xa mọi yêu cầu tác vụ của bạn —
        từ đa nhiệm mượt mà, xử lý đồ họa chuyên nghiệp đến chơi game.  
        Thiết kế tinh tế, hiện đại và màn hình sắc nét mang đến trải nghiệm tuyệt vời.
        Đừng bỏ lỡ cơ hội sở hữu sản phẩm này!
    </p>
</div> <!--end nội dung-->
<!-- Phần sản phẩm nổi bật -->
<div id="sanphamnoibat">
    <div class="container my-5">
        <h2 class="text-center mb-4" style="text-align:center; color:aliceblue; padding-top:1em; 
            animation: blinkingText 1s infinite;">
            SẢN PHẨM LIÊN QUAN
        </h2>

        <div class="product-grid">
            @foreach ($related as $sp)
                <div class="product">
                    <div class="card d-block hvr-glow">

                        <a href="{{ url('/product/'.$sp->masp) }}" style="text-decoration:none;">
                            <img src="{{ asset($sp->hinhanh) }}" class="card-img-top product-image" alt="{{ $sp->tensp }}">

                            <div class="card-body">

                                <p class="fw-bold text-truncate product-name">{{ $sp->tensp }}</p>

                                <div class="product-specs">
                                    @if (!empty($sp->cpu))
                                        <li><p class="indam">CPU: {{ $sp->cpu }}</p></li>
                                    @endif

                                    @if (!empty($sp->ram))
                                        <li><p class="indam">RAM: {{ $sp->ram }}</p></li>
                                    @endif

                                    @if (!empty($sp->ocung))
                                        <li><p class="indam">Ổ cứng: {{ $sp->ocung }}</p></li>
                                    @endif
                                </div>

                                <div class="product-price">
                                    {{ number_format($sp->giasp, 0, ',', '.') }} VND
                                </div>

                            </div>
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div><!--end sản phẩn liên quan-->
<!-- đánh giá sản phẩm-->
 <div class="review-section mt-5">
    <h2 class="mb-3" style="font-weight:bold;">Đánh giá sản phẩm</h2>
    <div class="rating-summary" style="padding:20px 0;">
    <h3>Trung bình </h3>
 
<div style="display:flex; align-items:flex-start; gap:50px;">
    <!-- Khối điểm trung bình -->
    <div>
        <div style="font-size: 40px; font-weight:bold; margin-bottom:5px;">
        {{ $avgRating }}
        </div>

        <div>
            @for($i = 1; $i <= 5; $i++)
                @if($i <= round($avgRating))
                    <span style="color:#ffb400; font-size:28px;">★</span>
                @else
                    <span style="color:#ccc; font-size:28px;">★</span>
                @endif
            @endfor
        </div>
    </div>

    <!-- Khối thống kê sao -->
    <div style="margin-top:3px;">
        @foreach([5,4,3,2,1] as $star)
        <div style="display:flex; align-items:center; margin:5px 0;font-size: 25px;">
            <span style="width:50px; font-weight:bold;">{{ $star }} ★</span>

            <!-- Thanh bar -->
            <div style="
                height:8px;
                width:250px;
                background:#e5e5e5;
                border-radius:4px;
                margin:0 10px;
                overflow:hidden;
            ">
                <div style="
                    height:100%;
                    width: {{ $totalReviews > 0 ? ($ratingCounts[$star]/$totalReviews)*100 : 0 }}%;
                    background:#ff9800;
                "></div>
            </div>

            <span>{{ $ratingCounts[$star] }}</span>
        </div>
        @endforeach
    </div>

</div> <!-- END flex -->

    <!-- BỘ LỌC SAO -->
<div class="filter-rating" style="margin: 15px 0;">
    <form method="GET">
        <input type="hidden" name="masp" value="{{ $product->masp }}">
        <button name="star" value="" class="btn btn-sm {{ request('star')=='' ? 'btn-primary' : 'btn-outline-primary' }}" style="font-size: 1.2em;">Tất cả</button>
        @foreach([5,4,3,2,1] as $s)
            <button name="star" value="{{ $s }}" 
                class="btn btn-sm {{ request('star')==$s ? 'btn-primary' : 'btn-outline-primary' }}" style="font-size: 1.2em;">
                {{ $s }} ★ ({{ $ratingCounts[$s] }})
            </button>
        @endforeach
    </form>
</div>
</div>
    @if($reviews->count() == 0)
        <p>Chưa có đánh giá nào</p>
    @else

        @foreach($reviews as $rv)
            <div class="review-item border-bottom py-3">
                <div style="display:flex; align-items:center;">
                    <div class="stars mr-2">
                        <p>
                            <span style="font-size:1.2em; font-weight:bold; color:#333;">
                                {{ $rv->taikhoan->tentk ?? 'Người dùng' }}
                            </span>
                            <span style="font-size:1em; color:#777;">
                                {{ $rv->ngaytao ?? '' }}
                            </span>
                        </p>

                        @for($i=1; $i<=5; $i++)
                            @if($i <= $rv->rating)
                                <span style="color:#ffb400;font-size:22px;">★</span>
                            @else
                                <span style="color:#ccc;font-size:18px;">★</span>
                            @endif
                        @endfor
                    </div>
                </div>

                <p style="margin-top:4px;">{{ $rv->noidung }}</p>
            </div>
        @endforeach

        {{-- PHÂN TRANG Ở NGOÀI VÒNG LẶP --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div> <!--chỉ hiện phân trang khi số đánh giá >5-do đang cấu hình paginate(5)mục productcontroller.php-->
        <!--tự cầu hình thì như sau-->
        <div class="pagination-custom" style="margin-top: 15px; display:flex; justify-content: center; align-items:center; gap:10px;">

            {{-- Nút trước --}}
            @if ($reviews->currentPage() > 1)
                <a href="{{ $reviews->previousPageUrl() }}" class="page-btn" >&lt;</a>
            @else
                <span class="page-btn disabled" style="border: 1px solid red;">&lt;</span>
            @endif

            {{-- Số trang hiện tại / tổng số trang --}}
                <span>{{ $reviews->currentPage() }} / {{ $reviews->lastPage() }}</span>
            {{-- Nút sau --}}
            @if ($reviews->currentPage() < $reviews->lastPage())
                <a href="{{ $reviews->nextPageUrl() }}" class="page-btn" >&gt;</a>
            @else
                <span class="page-btn disabled" >&gt;</span>
            @endif

</div>
    @endif
</div>

</div>
<script>
    const qtyInput = document.getElementById('qty');
    const cartQty = document.getElementById('cart_qty');
    const buyQty = document.getElementById('buy_qty');

    // Gán số lượng vào cả hai form
    qtyInput.addEventListener('input', () => {
        cartQty.value = qtyInput.value;
        buyQty.value = qtyInput.value;
    });

    // Khởi tạo mặc định (value=1)
    cartQty.value = qtyInput.value;
    buyQty.value = qtyInput.value;
</script>
</body>
</html>
