<?php

namespace App\Http\Controllers;

use App\Models\Donnhap;
use App\Models\Chitietdonnhap;
use Illuminate\Http\Request;

class ImportOrderController extends Controller
{
    /** Danh sách đơn hàng */
public function index()
{
$orders = Donnhap::with('chitiet')->get();

foreach ($orders as $order) {
    $order->tongtien = $order->chitiet->sum(function($ct){
        return $ct->soluong * $ct->gianhap;
    });
}


    return view('pages.imports.donnhapAdmin', compact('orders'), [
            'title' => 'Quản lý đơn nhập'
        ]);
}



    /** Chi tiết đơn hàng */
    public function detail($madon)
    {
        $order = Donnhap::findOrFail($madon);
        $details = Chitietdonnhap::where('madn', $madon)->get();
        $order->tongtien = $order->phivanchuyen + 
                   $details->sum(function($d) {
                       return $d->gianhap * $d->soluong;
                   });

        return view('pages.imports.ctdonnhapAdmin', compact('order', 'details'), [
            'title' => 'Chi tiết đơn nhập'
        ]);
    }
public function search(Request $request)
{
    $keyword = $request->keyword;

    // 1. Tìm danh sách nhà cung cấp có tên giống keyword
    $supplierIds = \DB::table('nhacungcap')
        ->where('tenncc', 'LIKE', "%{$keyword}%")
        ->pluck('mancc');

    // 2. Tìm đơn nhập theo:
    // - mã đơn nhập (madn)
    // - hoặc nhà cung cấp (mancc)
    $orders = Donnhap::with(['ncc', 'chitiet'])
        ->where('madn', 'LIKE', "%{$keyword}%")
        ->orWhereIn('mancc', $supplierIds)
        ->get();

    // 3. Tính tổng tiền
    foreach ($orders as $order) {
        $order->tongtien = $order->chitiet->sum(function ($ct) {
            return $ct->soluong * $ct->gianhap; // SỬA ĐÚNG
        });
    }

    return view('pages.imports.donnhapAdmin', compact('orders', 'keyword'), [
        'title' => 'Kết quả tìm kiếm đơn nhập'
    ]);
}









}
