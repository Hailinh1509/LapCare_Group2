<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Lấy param lọc từ URL (nếu có): ?cat=...&keyword=...
        $cat     = $request->query('cat');
        $keyword = trim($request->query('keyword', ''));

        // Danh mục sản phẩm
        $categories = DB::table('loaisp')
            ->select('maloaisp', 'tenloaisp as tenloai')
            ->orderBy('tenloaisp')
            ->get();

        // Query sản phẩm chính (giống logic PHP cũ)
        $productsQuery = DB::table('sanpham');

        if ($cat) {
            $productsQuery->where('maloaisp', $cat);
        }

        if ($keyword !== '') {
            $productsQuery->where('tensp', 'like', '%' . $keyword . '%');
        }

        $products = $productsQuery
            ->orderBy('masp')
            ->limit(7)
            ->get();

        // FLASH SALE: 3 sản phẩm khuyến mãi cao nhất
        $flashProducts = DB::table('sanpham')
            ->where('khuyenmai', '>', 0)
            ->orderByDesc('khuyenmai')
            ->orderByDesc('giasp')
            ->limit(3)
            ->get();

        // Thời gian kết thúc flash sale: 30 ngày kể từ bây giờ
        $flashEndTime = now()->addDays(30)->timestamp;

        // Tiêu đề khối "Sản phẩm nổi bật"
        $heading = 'Sản phẩm nổi bật';
        if ($cat) {
            $cate = $categories->firstWhere('maloaisp', $cat);
            if ($cate) {
                $heading = 'Sản phẩm: ' . $cate->tenloai;
            }
        } elseif ($keyword !== '') {
            $heading = 'Kết quả tìm kiếm cho: ' . $keyword;
        }

        return view('home', [
            'categories'    => $categories,
            'products'      => $products,
            'flashProducts' => $flashProducts,
            'flashEndTime'  => $flashEndTime,
            'cat'           => $cat,
            'keyword'       => $keyword,
            'heading'       => $heading,
        ]);
    }
    // TRANG CHỦ SAU KHI ĐĂNG NHẬP
public function indexLogged(Request $request)
{
    // Lấy param lọc từ URL (nếu có): ?cat=...&keyword=...
    $cat     = $request->query('cat');
    $keyword = trim($request->query('keyword', ''));

    // Danh mục sản phẩm
    $categories = DB::table('loaisp')
        ->select('maloaisp', 'tenloaisp as tenloai')
        ->orderBy('tenloaisp')
        ->get();

    // Query sản phẩm chính (GIỐNG HỆT index)
    $productsQuery = DB::table('sanpham');

    if ($cat) {
        $productsQuery->where('maloaisp', $cat);
    }

    if ($keyword !== '') {
        $productsQuery->where('tensp', 'like', '%' . $keyword . '%');
    }

    $products = $productsQuery
        ->orderBy('masp')
        ->limit(7)
        ->get();

    // FLASH SALE: 3 sản phẩm khuyến mãi cao nhất
    $flashProducts = DB::table('sanpham')
        ->where('khuyenmai', '>', 0)
        ->orderByDesc('khuyenmai')
        ->orderByDesc('giasp')
        ->limit(3)
        ->get();

    // Thời gian kết thúc flash sale: 30 ngày kể từ bây giờ
    $flashEndTime = now()->addDays(30)->timestamp;

    // Tiêu đề khối "Sản phẩm nổi bật"
    $heading = 'Sản phẩm nổi bật';
    if ($cat) {
        $cate = $categories->firstWhere('maloaisp', $cat);
        if ($cate) {
            $heading = 'Sản phẩm: ' . $cate->tenloai;
        }
    } elseif ($keyword !== '') {
        $heading = 'Kết quả tìm kiếm cho: ' . $keyword;
    }

    // Gửi sang view GIỐNG y index, chỉ khác loggedIn = true
    return view('home', [
        'categories'    => $categories,
        'products'      => $products,
        'flashProducts' => $flashProducts,
        'flashEndTime'  => $flashEndTime,
        'cat'           => $cat,
        'keyword'       => $keyword,
        'heading'       => $heading,
        'loggedIn'      => true,    // <-- khác mỗi dòng này
    ]);
}

}
