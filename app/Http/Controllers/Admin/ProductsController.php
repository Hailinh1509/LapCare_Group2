<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tensp', 'like', "%{$search}%");
        }

        // Phân trang 10 sản phẩm/trang
        $products = $query->orderBy('ngaytao', 'desc')->paginate(10);

        return view('pages.products.index', [
            'title' => 'Tất Cả Sản Phẩm',
            'products' => $products,
            'search' => $request->search ?? ''
        ]);
    }
}
