<?php
namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;

class OrderDetailAdminController extends Controller
{
    public function show($madh)
    {
        // Lấy đơn hàng + user + chi tiết
        $order = DonHang::with(['user', 'chitiet.product'])
                        ->where('madh', $madh)
                        ->firstOrFail();

        // Tính tạm tính
        $tamtinh = $order->chitiet->sum(function ($ct) {
            return $ct->soluong * $ct->dongia;
        });

        // Tổng tiền (tạm tính + phí ship)
        $tongtien = $tamtinh + $order->phivanchuyen;

        return view('pages.orders.orderDetailAdmin', compact(
            'order', 'tamtinh', 'tongtien'
        ));
    }
}


?>