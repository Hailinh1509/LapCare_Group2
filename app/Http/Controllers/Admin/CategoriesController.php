<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index() {
        return view('pages.categories.index', ['title' => 'Danh Mục']);
    }

    public function create() {
        return view('pages.categories.create', ['title' => 'Thêm Danh Mục']);
    }
}
