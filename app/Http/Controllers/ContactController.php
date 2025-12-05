<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Danh sách review (tối giản)
    public function index()
    {
        return view('pages.contacts.index', [
            'title' => 'Quản Lý Đánh Giá'
        ]);
    }
}