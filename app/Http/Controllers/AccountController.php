<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Donhang;
use App\Models\ChiTietDonhang;
use App\Models\Rating;

class AccountController extends Controller
{
    // ============================
    //  TRANG THÔNG TIN TÀI KHOẢN
    // ============================
    public function index()
    {
        $user = Auth::user();
        return view('pages.accounts.index', compact('user'));
    }

    // ============================
    //  TRANG SỬA THÔNG TIN
    // ============================
    public function edit()
    {
        $user = Auth::user();
        return view('pages.accounts.edit', compact('user'));
    }

    // ============================
    //  XỬ LÝ CẬP NHẬT THÔNG TIN
    // ============================
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'sdt'    => 'nullable|string|digits:10',
            'diachi' => 'nullable|string|max:255',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->sdt    = $request->sdt;
        $user->diachi = $request->diachi;
        $user->save();

        return redirect()->route('accounts.edit')->with('success', 'Cập nhật thành công!');
    }

    // ============================
    //  DANH SÁCH ĐƠN HÀNG CỦA USER
    // ============================
    public function orders()
    {
        $user = Auth::user();

        $orders = Donhang::where('matk', $user->matk)
            ->orderBy('created_at', 'desc')
            ->get();

        // Tính tổng tiền cho mỗi đơn
        foreach ($orders as $order) {
            $tongHang = ChiTietDonhang::where('mahd', $order->madh)
                ->selectRaw('SUM(soluong * dongia) as tong')
                ->value('tong') ?? 0;

            $order->tongtien = $tongHang + $order->phivanchuyen + $order->VAT;
        }

        return view('pages.accounts.orders', compact('orders'));
    }

    // ============================
    //  XEM CHI TIẾT ĐƠN HÀNG
    // ============================
    public function detailed_orders($madh)
    {
        $user = Auth::user();

        // Lấy đơn hàng theo mã và đúng tài khoản đang đăng nhập
        $order = Donhang::where('madh', $madh)
            ->where('matk', $user->matk)
            ->firstOrFail();

        // Lấy chi tiết đơn hàng + thông tin sản phẩm
        $details = ChiTietDonhang::where('mahd', $madh)
            ->join('sanpham', 'chitietdonhang.masp', '=', 'sanpham.masp')
            ->select(
                'chitietdonhang.*',
                'sanpham.tensp',
                'sanpham.hinhanh',
                'sanpham.giasp'
            )
            ->get();

        // Lấy đánh giá hiện có của user cho đơn hàng này
        $ratings = Rating::where('matk', $user->matk)
            ->where('mahd', $madh)
            ->get();

        return view('pages.accounts.detailed_orders', compact('order', 'details', 'ratings'));
    }

    // ============================
    //  XỬ LÝ GỬI ĐÁNH GIÁ SẢN PHẨM
    // ============================
    public function submitRating(Request $request)
    {
        $request->validate([
            'masp'    => 'required|exists:sanpham,masp',
            'mahd'    => 'required|exists:donhang,madh',
            'noidung' => 'nullable|string|max:500',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::user()->matk;

        // Update hoặc tạo mới đánh giá
        Rating::updateOrCreate(
            [
                'matk' => $userId,
                'masp' => $request->masp,
                'mahd' => $request->mahd
            ],
            [
                'rating'   => $request->rating,
                'noidung'  => $request->noidung,
                'ngaytao'  => now(),
                'ngaysua'  => now(),
            ]
        );

        return back()->with('success', 'Đánh giá sản phẩm thành công!');
    }
}
