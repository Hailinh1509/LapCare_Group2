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
