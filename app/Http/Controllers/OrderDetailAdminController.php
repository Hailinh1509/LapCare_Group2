<?php
namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;

class OrderDetailAdminController extends Controller
{
    public function show($madh)
    {
        $order = DonHang::with(['user','chitiet.product'])
                ->where('madh', $madh)
                ->firstOrFail();

        $details = $order->chitiet ?? collect();

        $tongSanPham = $details->sum(function($ct){
            return (float)$ct->soluong * (float)$ct->dongia;
        });

        $vat  = (float) ($order->VAT ?? 0);
        $ship = (float) ($order->phivanchuyen ?? 0);

        // Thành tiền cuối
        $thanhtien = $tongSanPham - $vat - $ship;

        return view(
            'pages.orders.orderDetailAdmin',
            compact('order','details','tongSanPham','vat','ship','thanhtien'),
            [
                'title' => 'Chi tiết đơn đặt hàng'
            ]
        );
    }
}
?>
