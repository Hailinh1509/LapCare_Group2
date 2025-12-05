<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Danh sách review (tối giản)
    public function index()
    {
        return view('pages.reviews.index', [
            'title' => 'Quản Lý Đánh Giá'
        ]);
    }
}
