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
        $cartItems = GioHang::where('matk', $user->id)
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

    // ============================
    // ⭐ CẬP NHẬT SỐ LƯỢNG
    // ============================
    /*public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user) return redirect('/login');

        foreach ($request->qty as $masp => $soluong) {
            $soluong = max(1, (int) $soluong);

            GioHang::where('matk', $user->id)
                ->where('masp', $masp)
                ->update(['soluong' => $soluong]);
        }

        return back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }*/
    public function updateQty(Request $request)
{
    GioHang::where('matk', auth()->id())
        ->where('masp', $request->masp)
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

        GioHang::where('matk', $user->id)
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

        GioHang::where('matk', $user->id)->delete();

        return back()->with('success', 'Đã xoá toàn bộ giỏ hàng!');
    }
}
