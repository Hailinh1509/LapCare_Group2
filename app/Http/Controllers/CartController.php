<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\GioHang;

class CartController extends Controller
{
    // Hiển thị trang giỏ hàng
        public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng!');
        }

        // Lấy các sản phẩm từ giỏ hàng + join bảng sanpham
        $cartItems = GioHang::where('matk', $user->matk)
            ->join('sanpham', 'giohang.masp', '=', 'sanpham.masp')
            ->select(
                'giohang.*',
                'sanpham.tensp',
                'sanpham.giasp',
                'sanpham.hinhanh',
                'sanpham.khuyenmai'
            )
            ->get();

        return view('pages.cart', compact('cartItems'));
    }

    public function updateQty(Request $request)
{
    GioHang::where('matk', auth()->id())
        ->where('masp', $request->matk)
        ->update(['soluong' => $request->soluong]);

    return response()->json(['ok' => true]);
}

    // ============================
    // ⭐ XOÁ 1 SẢN PHẨM KHỎI GIỎ
    // ============================
    public function remove($masp)
    {
        $user = auth()->user();
        if (!$user) return redirect('/login');

        GioHang::where('matk', $user->matk)
            ->where('masp', $masp)
            ->delete();

        return back()->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng!');
    }


    // ============================
    // ⭐ XOÁ TOÀN BỘ GIỎ
    // ============================
    public function clear()
    {
        $user = auth()->user();
        if (!$user) return redirect('/login');

        GioHang::where('matk', $user->matk)->delete();

        return back()->with('success', 'Đã xoá toàn bộ giỏ hàng!');
    }
}
