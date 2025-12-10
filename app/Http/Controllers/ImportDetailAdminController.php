<?php

namespace App\Http\Controllers;

use App\Models\Donnhap;
use App\Models\Chitietdonnhap;
use Illuminate\Http\Request;

class ImportDetailAdminController extends Controller
{
    public function show($madn)
    {
        // Lấy đơn nhập + nhà cung cấp
        $order = Donnhap::with(['user', 'ncc'])->findOrFail($madon);

        // Lấy chi tiết đơn nhập + sản phẩm
        $details = Chitietdonnhap::with('product')
                    ->where('madn', $madn)
                    ->get();

        // Tính tổng tiền
        $tamtinh = $details->sum(function ($ct) {
            return $ct->soluong * $ct->gianhap;
        });

        $tongtien = $tamtinh; // không có phí vận chuyển trong đơn nhập

        return view('pages.imports.ctdonnhapAdmin', compact(
            'order', 'details', 'tamtinh', 'tongtien'
        ));
    }
}
