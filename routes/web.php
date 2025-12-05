<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Trang chủ (home page)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Danh sách sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.list');

// Chi tiết sản phẩm (VD: /products/5)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.detail');

//Đang mặc định tạo hiện trang này để test 
Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', function () {
    return view('pages.dashboard', ['title' => 'Dashboard']);
})->name('dashboard');

// CATEGORIES
Route::get('/categories', fn() => view('pages.categories.index', ['title'=>'Tất cả danh mục']))->name('categories.index');
Route::get('/categories/create', fn() => view('pages.categories.create', ['title'=>'Thêm danh mục']))->name('categories.create');

// PRODUCTS
Route::get('/products', fn() => view('pages.products.index', ['title'=>'Tất cả sản phẩm']))->name('products.index');
Route::get('/products/create', fn() => view('pages.products.create', ['title'=>'Thêm sản phẩm']))->name('products.create');

// SINGLE PAGE ROUTES
Route::get('/reviews', fn() => view('pages.reviews.index', ['title'=>'Quản lý đánh giá']))->name('reviews.index');
Route::get('/contacts', fn() => view('pages.contacts.index', ['title'=>'Quản lý liên hệ']))->name('contacts.index');
Route::get('/orders', fn() => view('pages.orders.index', ['title'=>'Quản lý đơn hàng']))->name('orders.index');

// ACCOUNTS
Route::get('/accounts', fn() => view('pages.accounts.index', ['title'=>'Tất cả tài khoản']))->name('accounts.index');
Route::get('/accounts/create', fn() => view('pages.accounts.create', ['title'=>'Thêm tài khoản']))->name('accounts.create');
Route::get('/employees', fn() => view('pages.accounts.employees', ['title'=>'Tài khoản nhân viên']))->name('employees.index');
Route::get('/customers', fn() => view('pages.accounts.customers', ['title'=>'Tài khoản khách hàng']))->name('customers.index');

/*Route::get('/', function () {
    return view('detail');
});*/


Route::get('/product/{masp}', [ProductController::class, 'detail'])
    ->name('product.detail');
//use App\Http\Controllers\ProductController;
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/buy-now', [ProductController::class, 'buyNow'])->name('buy.now');
Route::post('/product/{masp}/review', [ProductController::class, 'addReview'])
    ->name('product.review')->middleware('auth');
Route::get('/detail/{masp}', [ProductController::class, 'detail'])->name('detail');



