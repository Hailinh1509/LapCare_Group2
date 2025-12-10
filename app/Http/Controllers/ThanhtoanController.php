<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;   // <-- THÊM DÒNG NÀY

class ThanhtoanController extends Controller
{
    public function show($masp)
    {
        $product = DB::table('sanpham')->where('masp', $masp)->first();

        if (!$product) {
            abort(404);
        }

        // Lấy user đang đăng nhập
        $user = Auth::user();

        // Lấy thông tin từ tài khoản (đổi tên cột theo DB của bạn)
        $customerName    = $user?->name ?? 'Khách hàng Lapcare';
        $customerPhone   = $user?->sdt ?? '';      // ví dụ cột trong bảng users là "phone"
        $customerAddress = $user?->diachi ?? '';    // ví dụ cột là "address"

        return view('thanhtoan', [
            'product'         => $product,
            'customerName'    => $customerName,
            'customerPhone'   => $customerPhone,
            'customerAddress' => $customerAddress,
        ]);
    }


    public function showSelected(Request $request)
{
    //$maspList = $request->masp;  Đây là mảng các masp được tick
    $maspList = json_decode($request->masp);

    if (!$maspList || count($maspList) == 0) {
        return redirect()->back()->with('error', 'Bạn phải chọn ít nhất 1 sản phẩm để thanh toán.');
    }
    $user = auth()->user();
    // Lấy các sản phẩm tương ứng
    $products = DB::table('giohang')
        ->where('giohang.matk', $user->id)
        ->whereIn('giohang.masp', $maspList)
        ->join('sanpham', 'giohang.masp', '=', 'sanpham.masp')
        ->select(
            'giohang.soluong',      // số lượng người dùng chọn
            'giohang.masp',
            'sanpham.tensp',
            'sanpham.giasp',
            'sanpham.khuyenmai',
            'sanpham.hinhanh'
        )
        ->get();

    if ($products->isEmpty()) {
        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm nào.');
    }

    // Mock user (sau sẽ thay bằng Auth)
    $customerName    = 'Khách hàng Lapcare';
    $customerPhone   = '0356819205';
    $customerAddress = '';

    return view('pages.orderproduct', [
        'products'        => $products,
        'customerName'    => $customerName,
        'customerPhone'   => $customerPhone,
        'customerAddress' => $customerAddress,
    ]);
}


    // Xử lý form thanh toán
    public function process(Request $request, $masp)
    {
        $product = DB::table('sanpham')->where('masp', $masp)->first();
        if (!$product) {
            abort(404);
        }

        $data = $request->validate([
            'fullname'      => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:500',
            'note'          => 'nullable|string|max:1000',
            'payment_proof' => 'nullable|image|max:4096', // tối đa 4MB
        ]);

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')
                                 ->store('payment_proofs', 'public');
        }

        // TODO: sau này lưu vào bảng orders,...

        return redirect()->route('home')
            ->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm.');
    }
}
