<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Không cần __construct() nữa

    /**
     * Trang thông tin khách hàng
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.accounts.index', compact('user'));
    }

    /**
     * Trang chỉnh sửa thông tin
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.accounts.edit', compact('user'));
    }

    /**
     * Xử lý cập nhật thông tin
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'sdt' => 'nullable|string|max:20',
            'diachi' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Cập nhật thông tin thành công.');
    }

    /**
     * Trang danh sách đơn hàng của người dùng
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders ?? [];
        return view('accounts.orders', compact('orders'));
    }
}
