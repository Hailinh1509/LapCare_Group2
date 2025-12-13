<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ThanhtoanController;
use App\Http\Controllers\AdminAuthController;

// Trang chủ (home page)
Route::get('/', [HomeController::class, 'index'])->name('home');
// Trang chủ cho người dùng đã đăng nhập
Route::get('/home-logged', [HomeController::class, 'indexLogged'])->name('home.logged');
//Route::get('/home-logged', [HomeController::class, 'indexLogged'])->name('home.logged');

// Trang chi tiết sản phẩm cho người dùng
Route::get('/san-pham/{masp}', [PageController::class, 'detail'])
    ->name('product.detail');
// Trang "Về chúng tôi"
Route::get('/ve-chung-toi', [PageController::class, 'about'])->name('about');


//HẢI LINH (TÀI KHOẢN) 
use App\Http\Controllers\AccountController;
Route::middleware(['auth'])->prefix('account')->name('accounts.')->group(function() {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/edit', [AccountController::class, 'edit'])->name('edit');
    Route::post('/update', [AccountController::class, 'update'])->name('update');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{madh}', [AccountController::class, 'detailed_orders'])
    ->name('detailed_orders');
    Route::post('/orders/{madh}/rate', [AccountController::class, 'submitRating'])->name('rate_product');
});

// Tin tức
Route::get('/tin-tuc', [PageController::class, 'news'])->name('news.index');

// Liên hệ
Route::get('/lien-he', [PageController::class, 'contact'])->name('contact');

// Giỏ hàng
use App\Http\Controllers\CartController;
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{masp}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Trang đăng nhập
Route::get('/dang-nhap', [PageController::class, 'login'])->name('login');

// Xử lý đăng nhập
Route::post('/dang-nhap', [PageController::class, 'processLogin'])->name('login.process');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.process');

use App\Http\Controllers\PasswordController;

// Chỉ cho user đã đăng nhập
Route::middleware('auth')->group(function () {

    // Form đổi mật khẩu
    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])
        ->name('password.change');

    // Submit đổi mật khẩu
    Route::post('/password/change', [PasswordController::class, 'change'])
        ->name('password.change.submit');
});



Route::get('/buy-now/{masp}', [CartController::class, 'addFromBuyNow'])
    ->name('buy.now');



Route::get('/thanh-toan/{masp}', [CartController::class, 'addFromBuyNow'])
    ->name('buy.now');


Route::post('/thanh-toan/{masp}', [ThanhtoanController::class, 'process'])
    ->middleware('auth')   // optional nhưng nên thêm
    ->name('thanhtoan.process');

Route::post('/checkout/submit', [ThanhtoanController::class, 'submit'])
    ->name('checkout.submit')
    ->middleware('auth');

Route::get('/order-success', function () {
    return view('pages.order_success');
})->name('order.success');




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
| ADMIN + DASHBOARD
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| ADMIN CATEGORIES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{maloaisp}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{maloaisp}', [CategoryController::class, 'update'])->name('categories.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN PRODUCTS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminProductsController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/products', [AdminProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductsController::class, 'store'])->name('products.store');
    Route::get('/products/{masp}/edit', [AdminProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{masp}', [AdminProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductsController::class, 'delete'])->name('products.delete');

});
/*
|--------------------------------------------------------------------------
| CUSTOMERS PRODUCTS
|--------------------------------------------------------------------------
*/
// Trang danh sách sản phẩm
Route::get('/products', [ProductsController::class, 'index'])->name('products.list');

//Trang chi tiết sản phẩm
use App\Http\Controllers\DetailController;
Route::get('/products/{masp}', [DetailController::class, 'detail'])->name('products.detail');


// Thêm vào giỏ hàng
Route::post('/cart/add', [DetailController::class, 'addToCart'])
    ->middleware('auth')
    ->name('cart.add');

// Mua ngay

Route::post('/buy-now/{masp}', [ThanhtoanController::class, 'show'])->name('buy.now');

// Gửi đánh giá
Route::post('/product/{masp}/review', [DetailController::class, 'addReview'])->name('product.review');

Route::post('/buy-now/{masp}', [ThanhtoanController::class, 'show'])->name('buy.now');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//Route::post('/cart/add', [DetailController::class, 'addToCart'])    ->name('cart.add');
//Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/update-qty', [CartController::class, 'updateQty'])->name('cart.updateQty');
Route::get('/cart/remove/{masp}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
//xử lý nút đặt 
Route::get('/checkout', [ThanhtoanController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ThanhtoanController::class, 'showSelected'])
    ->name('cart.checkout');
Route::post('/checkout/process', [ThanhtoanController::class, 'process'])
    ->name('checkout.process');

// Trang cảm ơn (tuỳ bạn)
Route::get('/checkout/success', [ThanhtoanController::class, 'success'])->name('checkout.success');

/*
|--------------------------------------------------------------------------
| EMPLOYEES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\EmployeeController;
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
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
});


/*
|--------------------------------------------------------------------------
| CUSTOMERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CustomersController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers/search', [CustomersController::class, 'search'])->name('customers.search');
});
/*
|--------------------------------------------------------------------------
| policy page
|--------------------------------------------------------------------------
*/
Route::get('/policies/ShipPay', function () {
    return view('policies.ShipPay');
})->name('policy.ShipPay');

Route::get('/policies/warranty', function () {
    return view('policies.warranty');
})->name('policy.warranty');

Route::get('/policies/returns', function () {
    return view('policies.returns');
})->name('policy.returns');

Route::get('/policies/privacy', function () {
    return view('policies.privacy');
})->name('policy.privacy');
/*
Route::get('/policies/delivery', function () {
    return view('policies.delivery');
})->name('policy.delivery');
*/
Route::get('/policies/operation-regulation', function () {
    return view('policies.operation');
})->name('policy.operation');


/*
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ReviewController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.delete');
});

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/
/*
use App\Http\Controllers\OrderController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
/*
|--------------------------------------------------------------------------
| ORDERS - thông tin đơn hàng và chi tiết đơn hàng
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\OrderDetailAdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/orders', [OrderAdminController::class, 'index'])->name('orders.index');
    Route::get('/orders/search', [OrderAdminController::class, 'search'])->name('orders.search');

    //
    Route::get('/orders/{madh}', [OrderDetailAdminController::class, 'show'])
        ->name('orders.detail');

    Route::post('/orders/update-payment', [OrderAdminController::class, 'updatePayment'])
        ->name('orders.updatePayment');

    Route::post('/orders/update-shipping', [OrderAdminController::class, 'updateShipping'])
        ->name('orders.updateShipping');
});



/*
|--------------------------------------------------------------------------
| SUPPLIERS (NHÀ CUNG CẤP)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SupplierController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
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

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/imports', [ImportOrderController::class, 'index'])->name('imports.index');
    Route::post('/imports/update-payment', [ImportOrderController::class, 'updatePayment'])
        ->name('imports.updatePayment');
    Route::get('/imports/create', [ImportOrderController::class, 'create'])->name('imports.create');
    Route::get('/imports/search', [ImportOrderController::class, 'search'])->name('imports.search');
    Route::post('/imports', [ImportOrderController::class, 'store'])->name('imports.store');
    Route::get('/imports/{id}/edit', [ImportOrderController::class, 'edit'])->name('imports.edit');
    Route::put('/imports/{id}', [ImportOrderController::class, 'update'])->name('imports.update');
    Route::delete('/imports/{id}', [ImportOrderController::class, 'destroy'])->name('imports.destroy');
    Route::get('/imports/{madon}', [ImportOrderController::class, 'detail'])->name('imports.detail');
});

/*
|--------------------------------------------------------------------------
| ORDERS - thông tin đơn hàng và chi tiết đơn hàng
|--------------------------------------------------------------------------

use App\Http\Controllers\ImportOrderController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/imports', [ImportOrderController::class, 'index'])->name('imports.index');
    Route::get('/imports/search', [ImportOrderController::class, 'search'])->name('imports.search');
    Route::get('/imports/{madon}', [ImportOrderController::class, 'detail'])->name('imports.detail');
});
*/

require __DIR__.'/auth.php';