<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Trang welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Nhóm route profile (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

//Route::get('/', function () {
//    return view('detail');
//});

Route::get('/product/{masp}', [ProductController::class, 'detail'])
    ->name('product.detail');

Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');

Route::post('/buy-now', [ProductController::class, 'buyNow'])->name('buy.now');

Route::post('/product/{masp}/review', [ProductController::class, 'addReview'])
    ->name('product.review')
    ->middleware('auth');

Route::get('/detail/{masp}', [ProductController::class, 'detail'])
    ->name('detail');

// Laravel Breeze Auth Routes
require __DIR__.'/auth.php';
