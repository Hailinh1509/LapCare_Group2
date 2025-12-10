<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index()
    {
        // Chỉ lấy user có role = 'user'
        $customers = User::where('role', 'user')->get();

        return view('pages.customers.customersAmin',
            compact('customers'),
            ['title' => 'Tài khoản khách hàng']
        );
    }



    // Tìm kiếm khách hàng theo tên
    public function search(Request $request)
    {
        $keyword = strtolower($request->input('keyword'));

        $customers = User::where('role', 'user')
            ->whereRaw('LOWER(name) LIKE ?', ["%$keyword%"])
            ->get();

        return view('pages.customers.customersAmin',
            compact('customers'),
            ['title' => 'Kết quả tìm kiếm']
        );
    }
}
