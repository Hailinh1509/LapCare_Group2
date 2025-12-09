<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>

<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <!-- Bootstrap để hiển thị đẹp -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<style>
    .cart-container {
        width: 90%;
        max-width: 1100px;
        margin: 40px auto 120px auto; /* cách xa footer */
    }

    table.cart-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    table.cart-table th,
    table.cart-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    table.cart-table th {
        background: #f8f8f8;
        font-weight: bold;
    }

    .qty-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        cursor: pointer;
        border: 1px solid #ccc;
        background: #eee;
        font-size: 16px;
        border-radius: 3px;
    }

    .qty-input {
        width: 50px;
        text-align: center;
        padding: 4px;
    }

    .cart-buttons {
        margin-top: 25px;
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .cart-btn {
        padding: 10px 22px;
        border: none;
        background: #0066cc;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        font-size: 15px;
    }

    .cart-btn:hover {
        opacity: 0.85;
    }

    .btn-danger { background: #cc0000; }
    .btn-light { background: #555; }

    .total-box {
        text-align: right;
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
    }

    .price-highlight {
        color: #d60000;
    }
</style>
</head>
<body>
@include('header.header')

<!--@section('content')-->
<div class="cart-container">

    <h2 style="text-align:center; margin-bottom:20px;">Giỏ hàng của bạn</h2>

    @if ($cartItems->isEmpty())
        <div style="text-align:center; padding:40px 0;">
            <h3>Giỏ hàng đang trống</h3>
            <a href="/" class="cart-btn btn-light">Mua sắm ngay</a>
        </div>
    @else

    <table class="cart-table">
        <thead>
            <tr>
                <th width="60">Chọn</th>
                <th>Sản phẩm</th>
                <th width="150">Đơn giá</th>
                <th width="150">Số lượng</th>
                <th width="150">Thành tiền</th>
                <th width="100">Xóa</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($cartItems as $item)
                @php
                    $dongia = $item->giasp;
                    $thanhtien = $item->soluong * $dongia;
                @endphp

                <tr data-price="{{ $dongia }}">
                    <td>
                        <input type="checkbox" class="item-check">
                    </td>

                    <td style="text-align:left;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <img src="{{ asset($item->hinhanh) }}" width="70" style="border-radius:6px; border:1px solid #ddd;">
                            <strong>{{ $item->tensp }}</strong>
                        </div>
                    </td>

                    <td class="unit-price">{{ number_format($dongia) }} đ</td>

                    <td>
                        <div class="qty-box">
                            <button class="qty-btn minus">−</button>
                            <input type="text" class="qty-input" value="{{ $item->soluong }}">
                            <button class="qty-btn plus">+</button>
                        </div>
                    </td>

                    <td class="item-total price-highlight">{{ number_format($thanhtien) }} đ</td>

                    <td>
                        <a href="{{ route('cart.remove', $item->masp) }}"
                           class="cart-btn btn-danger"
                           style="padding:4px 10px;">
                           Xóa
                        </a>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>

    <!-- Tổng tiền chỉ tính theo mục được tích -->
    <div class="total-box">
        Tổng tiền: <span id="grand-total" class="price-highlight">0 đ</span>
    </div>

    <!-- Nút nằm ngang bằng CSS -->
    <div class="cart-buttons">
        <a href="{{ route('products.list') }}" class="cart-btn btn-light">Tiếp tục mua hàng</a>
        <a href="{{ route('cart.clear') }}" class="cart-btn btn-danger">Xóa giỏ hàng</a>
        <a href="#" class="cart-btn btn-success" id="checkout-btn">Thanh toán</a>
    </div>

    @endif

</div>

<script>
    // Cập nhật số lượng & thành tiền từng dòng
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("plus") || e.target.classList.contains("minus")) {

            let row = e.target.closest("tr");
            let input = row.querySelector(".qty-input");
            let qty = parseInt(input.value);

            if (e.target.classList.contains("plus")) qty++;
            if (e.target.classList.contains("minus") && qty > 1) qty--;

            input.value = qty;

            // cập nhật thành tiền
            let price = parseInt(row.dataset.price);
            let itemTotal = qty * price;
            row.querySelector(".item-total").innerText = itemTotal.toLocaleString() + " đ";

            updateGrandTotal();
        }
    });

    // Khi click checkbox thì tính tổng
    document.addEventListener("change", function(e) {
        if (e.target.classList.contains("item-check")) {
            updateGrandTotal();
        }
    });

    // Hàm tính tổng tiền chỉ theo sản phẩm được tích
    function updateGrandTotal() {
        let total = 0;

        document.querySelectorAll("tbody tr").forEach(row => {
            let checkbox = row.querySelector(".item-check");
            if (checkbox.checked) {
                let itemTotal = row.querySelector(".item-total").innerText.replace(/[^\d]/g, "");
                total += parseInt(itemTotal);
            }
        });

        document.getElementById("grand-total").innerText = total.toLocaleString() + " đ";
    }
</script>
@include('footer.footer')
</body>
</html>