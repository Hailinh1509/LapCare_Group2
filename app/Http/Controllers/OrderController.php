<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Danh sách review (tối giản)
    public function index()
    {
        return view('pages.orders.index', [
            'title' => 'Quản Lý Đánh Giá'
        ]);
    }
}