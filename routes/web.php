<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| USER ROUTES (Giao diện khách hàng)
|--------------------------------------------------------------------------
*/

// Trang chủ
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;

// 1.Trang chủ (home page)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2.Danh sách sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.list');
// 3.Chi tiết sản phẩm (VD: /products/5)
Route::get('/product/{masp}', [DetailController::class, 'detail'])->name('product.detail');
//3.1nút thêm vào giỏ
Route::post('/cart/add', [DetailController::class, 'addToCart'])->name('cart.add');
//3.2nút mua hàng
Route::post('/buy-now', [DetailController::class, 'buyNow'])->name('buy.now');
//3.3thêm đánh giá
Route::post('/product/{masp}/review', [DetailController::class, 'addReview'])
    ->name('product.review')->middleware('auth');
Route::get('/detail/{masp}', [DetailController::class, 'detail'])->name('detail');

// Chi tiết sản phẩm (Layout cũ)
Route::get('/detail/{masp}', [ProductController::class, 'detail'])->name('detail');

// Review sản phẩm
Route::post('/product/{masp}/review', [ProductController::class, 'addReview'])
    ->middleware('auth')
    ->name('product.review');

// Thêm vào giỏ hàng
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');

// Mua ngay
Route::post('/buy-now', [ProductController::class, 'buyNow'])->name('buy.now');


/*
|--------------------------------------------------------------------------
| DASHBOARD + ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// Dashboard dành cho Admin
Route::get('/dashboard', function () {
    return view('pages.dashboard', ['title' => 'Dashboard']);
})
->middleware(['auth', 'verified'])
->name('dashboard');
// Danh mục
Route::get('/categories', fn() => view('pages.categories.index', ['title'=>'Tất cả danh mục']))->name('categories.index');
Route::get('/categories/create', fn() => view('pages.categories.create', ['title'=>'Thêm danh mục']))->name('categories.create');

// CATEGORIES
//Route::get('/categories', fn() => view('pages.categories.index', ['title'=>'Tất cả danh mục']))->name('categories.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

//Route::get('/categories/create', fn() => view('pages.categories.create', ['title'=>'Thêm danh mục']))->name('categories.create');

// Products (Admin)
Route::get('/admin/products', fn() => view('pages.products.index', ['title'=>'Tất cả sản phẩm']))->name('products.index');
Route::get('/admin/products/create', fn() => view('pages.products.create', ['title'=>'Thêm sản phẩm']))->name('products.create');

// Các trang đơn
Route::get('/reviews', fn() => view('pages.reviews.index', ['title'=>'Quản lý đánh giá']))->name('reviews.index');
Route::get('/contacts', fn() => view('pages.contacts.index', ['title'=>'Quản lý liên hệ']))->name('contacts.index');
Route::get('/orders', fn() => view('pages.orders.index', ['title'=>'Quản lý đơn hàng']))->name('orders.index');

// Accounts
Route::get('/accounts', fn() => view('pages.accounts.index', ['title'=>'Tất cả tài khoản']))->name('accounts.index');
Route::get('/accounts/create', fn() => view('pages.accounts.create', ['title'=>'Thêm tài khoản']))->name('accounts.create');
Route::get('/employees', fn() => view('pages.accounts.employees', ['title'=>'Tài khoản nhân viên']))->name('employees.index');
Route::get('/customers', fn() => view('pages.accounts.customers', ['title'=>'Tài khoản khách hàng']))->name('customers.index');



/*
|--------------------------------------------------------------------------
| PROFILE (Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

// Trang sản phẩm
Route::get('/sanpham', [ProductsController::class, 'index'])->name('products.index');
//Trang tài khoản (khách hàng và nhân viên trong admin)
// routes/web.php
use App\Http\Controllers\EmployeeController;

// Danh sách
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Thêm nhân viên
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Sửa nhân viên
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

// Xóa nhân viên
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

//Tìm kiếm nhân viên
Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');

//Trang tài khoản khách hàng (admin)
use App\Http\Controllers\CustomersController;

Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
//Tìm kiếm khách hàng
Route::get('/customers/search', [CustomersController::class, 'search'])->name('customers.search');

/*Route::get('/', function () {
    return view('detail');
});*/


/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
