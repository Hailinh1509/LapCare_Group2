<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\GioHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    GioHang::where('matk', auth()->user()->matk)
        ->where('masp', $request->matk)
        ->update(['soluong' => $request->soluong]);

    return response()->json(['ok' => true]);
}
public function addFromBuyNow($masp)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để mua hàng.');
    }

    $user = Auth::user();
    $matk = $user->matk;

    // kiểm tra sản phẩm tồn tại
    $sp = DB::table('sanpham')->where('masp', $masp)->first();
    if (!$sp) abort(404);

    // nếu đã có trong giỏ thì +1, chưa có thì insert
    $exist = DB::table('giohang')->where('matk', $matk)->where('masp', $masp)->first();

    if ($exist) {
        DB::table('giohang')
            ->where('matk', $matk)->where('masp', $masp)
            ->update(['soluong' => $exist->soluong + 1]);
    } else {
        DB::table('giohang')->insert([
            'matk' => $matk,
            'masp' => $masp,
            'soluong' => 1,
        ]);
    }

    // chuyển về giỏ hàng hoặc checkout
    return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
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
