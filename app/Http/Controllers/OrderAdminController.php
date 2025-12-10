<?php

namespace App\Http\Controllers;

use App\Models\Donhang;
use App\Models\Chitietdonhang;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    /** Danh sách đơn hàng */
public function index()
{
$orders = Donhang::with('chitiet')->get();

foreach ($orders as $order) {
    $order->tongtien = $order->chitiet->sum(function($ct){
        return $ct->soluong * $ct->dongia;
    });
}


    return view('pages.orders.ordersAdmin', compact('orders'), [
            'title' => 'Quản lý đơn hàng'
        ]);
}



    /** Chi tiết đơn hàng */
    public function detail($madon)
    {
        $order = Donhang::findOrFail($madon);
        $details = Chitietdonhang::where('mahd', $madon)->get();
        $order->tongtien = $order->phivanchuyen + 
                   $details->sum(function($d) {
                       return $d->dongia * $d->soluong;
                   });

        return view('pages.orders.orderDetailAdmin', compact('order', 'details'), [
            'title' => 'Chi tiết đơn hàng'
        ]);
    }
public function search(Request $request)
{
    $keyword = $request->keyword;

    // 1. Lấy danh sách id khách hàng có tên giống keyword
    $userIds = \DB::table('users')
        ->where('name', 'LIKE', "%{$keyword}%")
        ->pluck('matk');

    // 2. Tìm đơn hàng theo:
    //  - mã đơn
    //  - hoặc mã khách nằm trong danh sách tìm được
    $orders = Donhang::with(['user', 'chitiet'])
        ->where('madh', 'LIKE', "%{$keyword}%")
        ->orWhereIn('matk', $userIds)
        ->get();

    // 3. Tính tổng tiền
    foreach ($orders as $order) {
        $order->tongtien = $order->chitiet->sum(function ($ct) {
            return $ct->soluong * $ct->dongia;
        });
    }

    return view('pages.orders.ordersAdmin', compact('orders', 'keyword'), [
            'title' => 'Kết quả tìm kiếm đơn hàng'
        ]);
}








}
