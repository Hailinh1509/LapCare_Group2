<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ThanhtoanController;

// Trang chủ (home page)
Route::get('/', [HomeController::class, 'index'])->name('home');
// Trang chủ cho người dùng đã đăng nhập
Route::get('/home-logged', [HomeController::class, 'indexLogged'])->name('home.logged');


// Trang "Về chúng tôi"
Route::get('/ve-chung-toi', [PageController::class, 'about'])->name('about');

// Danh sách sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.list');

// Chi tiết sản phẩm (VD: /products/5)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.detail');

// Trang sản phẩm
Route::get('/san-pham', [PageController::class, 'products'])->name('products.index');

// Tin tức
Route::get('/tin-tuc', [PageController::class, 'news'])->name('news.index');

// Liên hệ
Route::get('/lien-he', [PageController::class, 'contact'])->name('contact');

// Giỏ hàng
Route::get('/gio-hang', [PageController::class, 'cart'])->name('cart');

// Trang đăng nhập (sau này gắn auth)
Route::get('/dang-nhap', [PageController::class, 'login'])->name('login');


Route::get('/thanh-toan/{masp}', [ThanhtoanController::class, 'show'])
    ->name('thanhtoan.show');

Route::post('/thanh-toan/{masp}', [ThanhtoanController::class, 'process'])
    ->name('thanhtoan.process');
    
// Một số trang chính sách cho footer (tạm đặt tên)
Route::get('/chinh-sach-giao-hang-thanh-toan', [PageController::class, 'policyShipping'])->name('policy.shipping');
Route::get('/chinh-sach-bao-hanh', [PageController::class, 'policy.warranty'])->name('policy.warranty');
Route::get('/chinh-sach-doi-tra', [PageController::class, 'policy.return'])->name('policy.return');
Route::get('/chinh-sach-bao-mat-thong-tin', [PageController::class, 'policy.privacy'])->name('policy.privacy');
Route::get('/chinh-sach-van-chuyen', [PageController::class, 'policy.delivery'])->name('policy.delivery');
Route::get('/quy-che-hoat-dong', [PageController::class, 'policy.rules'])->name('policy.rules');