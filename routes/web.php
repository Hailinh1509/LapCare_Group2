<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ThanhtoanController;

// Trang chủ (home page)
Route::get('/', [HomeController::class, 'index'])->name('home');
// Trang chủ cho người dùng đã đăng nhập
Route::get('/home-logged', [HomeController::class, 'indexLogged'])->name('home.logged');

// Trang "Về chúng tôi"
Route::get('/ve-chung-toi', [PageController::class, 'about'])->name('about');

//HẢI LINH (TÀI KHOẢN)
Route::get('/account', function () {
    return view('pages.accounts.index');
})->name('account');




// Tin tức
Route::get('/tin-tuc', [PageController::class, 'news'])->name('news.index');

// Liên hệ
Route::get('/lien-he', [PageController::class, 'contact'])->name('contact');

// Giỏ hàng
Route::get('/gio-hang', [PageController::class, 'cart'])->name('cart');

// Trang đăng nhập
Route::get('/dang-nhap', [PageController::class, 'login'])->name('login');

// Xử lý đăng nhập
Route::post('/dang-nhap', [PageController::class, 'processLogin'])->name('login.process');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.process');






Route::get('/thanh-toan/{masp}', [ThanhtoanController::class, 'show'])
    ->name('thanhtoan.show');

Route::post('/thanh-toan/{masp}', [ThanhtoanController::class, 'process'])
    ->name('thanhtoan.process');
    

Route::get('/chinh-sach-giao-hang-thanh-toan', [PageController::class, 'policyShipping'])->name('policy.shipping');
Route::get('/chinh-sach-bao-hanh', [PageController::class, 'policy.warranty'])->name('policy.warranty');
Route::get('/chinh-sach-doi-tra', [PageController::class, 'policy.return'])->name('policy.return');
Route::get('/chinh-sach-bao-mat-thong-tin', [PageController::class, 'policy.privacy'])->name('policy.privacy');
Route::get('/chinh-sach-van-chuyen', [PageController::class, 'policy.delivery'])->name('policy.delivery');
Route::get('/quy-che-hoat-dong', [PageController::class, 'policy.rules'])->name('policy.rules');

/*
|--------------------------------------------------------------------------
| ADMIN + DASHBOARD
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\DashboardController;

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| ADMIN CATEGORIES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CategoryController;

Route::prefix('admin')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

});

/*
|--------------------------------------------------------------------------
| ADMIN PRODUCTS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminProductsController;

Route::prefix('admin')->group(function () {

    Route::get('/products', [AdminProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductsController::class, 'store'])->name('products.store');
    Route::get('/products/{masp}/edit', [AdminProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{masp}', [AdminProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductsController::class, 'delete'])->name('products.delete');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| EMPLOYEES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\EmployeeController;
    Route::prefix('admin')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
    
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

});


/*
|--------------------------------------------------------------------------
| CUSTOMERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CustomersController;

Route::prefix('admin')->group(function () {
Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
//Tìm kiếm khách hàng
Route::get('/customers/search', [CustomersController::class, 'search'])->name('customers.search');
});



/*
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ReviewController;

Route::prefix('admin')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
});

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\OrderController;

Route::prefix('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});


/*
|--------------------------------------------------------------------------
| SUPPLIERS (NHÀ CUNG CẤP)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SupplierController;

Route::prefix('admin')->group(function () {
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');

    Route::get('/suppliers/{mancc}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{mancc}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{mancc}', [SupplierController::class, 'delete'])->name('suppliers.delete');
});



/*
|--------------------------------------------------------------------------
| IMPORT ORDERS (ĐƠN NHẬP)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ImportOrderController;

Route::prefix('admin')->group(function () {
    Route::get('/imports', [ImportOrderController::class, 'index'])->name('imports.index');
    Route::get('/imports/create', [ImportOrderController::class, 'create'])->name('imports.create');
    Route::post('/imports', [ImportOrderController::class, 'store'])->name('imports.store');

    // CRUD đầy đủ (nếu muốn)
    Route::get('/imports/{id}/edit', [ImportOrderController::class, 'edit'])->name('imports.edit');
    Route::put('/imports/{id}', [ImportOrderController::class, 'update'])->name('imports.update');
    Route::delete('/imports/{id}', [ImportOrderController::class, 'destroy'])->name('imports.destroy');
});


require __DIR__.'/auth.php';
