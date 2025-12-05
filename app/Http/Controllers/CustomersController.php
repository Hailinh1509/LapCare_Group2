<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = TaiKhoan::all(); 
        return view('pages.customers.customersAmin', compact('customers'),
        ['title' => 'Tài khoản khách hàng']);
    }

    public function create()
    {
        return view('pages.customers.create');
    }

    public function edit($id)
    {
        $cus = TaiKhoan::findOrFail($id);
        return view('pages.customers.edit', compact('cus'));
    }

    public function destroy($id)
    {
        TaiKhoan::destroy($id);
        return redirect()->route('customers.index')->with('success', 'Xóa thành công');
    }
}
