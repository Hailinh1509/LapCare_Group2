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
