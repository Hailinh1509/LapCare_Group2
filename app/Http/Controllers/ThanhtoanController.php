<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThanhtoanController extends Controller
{
    /**
     * GET /checkout
     * Hiển thị trang thanh toán theo GIỎ HÀNG
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $user = Auth::user();
        $matk = $user->matk;

        // Lấy giỏ hàng + join sản phẩm
        $items = DB::table('giohang as g')
            ->join('sanpham as s', 's.masp', '=', 'g.masp')
            ->where('g.matk', $matk)
            ->select(
                'g.masp',
                'g.soluong',
                's.tensp',
                's.hinhanh',
                's.giasp',
                's.khuyenmai'
            )
            ->get()
            ->map(function ($it) {
                $gia = (float) $it->giasp;
                $km  = (float) ($it->khuyenmai ?? 0);
                $it->gia_tinh = $km > 0 ? $gia * (1 - $km) : $gia;
                return $it;
            });

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng đang trống.');
        }

        return view('thanhtoan', [
            'items'           => $items,
            'customerName'    => $user->name ?? 'Khách hàng LapCare',
            'customerPhone'   => $user->sdt ?? '',
            'customerAddress' => $user->diachi ?? '',
        ]);
    }

    /**
     * POST /checkout/process
     * Tạo đơn hàng từ GIỎ HÀNG
     */
    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập.');
        }

        $user = Auth::user();
        $matk = $user->matk;

        // Validate form (khớp với view)
        $data = $request->validate([
            'address'        => 'required|string|max:500',
            'note'           => 'nullable|string|max:2000',
            'payment_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Lấy giỏ hàng
        $cartItems = DB::table('giohang')
            ->where('matk', $matk)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng trống.');
        }

        // Tạo mã đơn DHxxx
        $max = DB::table('donhang')->max('madh'); // VD: DH012
        $next = 1;
        if ($max && preg_match('/^DH(\d{3})$/', $max, $m)) {
            $next = intval($m[1]) + 1;
        }
        $madh = 'DH' . str_pad($next, 3, '0', STR_PAD_LEFT);

        // Upload ảnh chuyển khoản (nếu có)
        if ($request->hasFile('payment_image')) {
            $request->file('payment_image')
                ->store('payment_proofs', 'public');
        }

        DB::beginTransaction();
        try {
            // 1. Insert DONHANG
            DB::table('donhang')->insert([
                'madh'           => $madh,
                'matk'           => $matk,
                'ngaydat'        => now()->toDateString(),
                'diachigiaohang' => $data['address'],
                'phivanchuyen'   => 30000,
                'VAT'            => 0,
                'pttt'           => 'QR/Chuyển khoản',
                'ttthanhtoan'    => 'chờ xác nhận',
                'ttvanchuyen'    => 'đang xử lý',
                'ghichu'         => $data['note'] ?? null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // 2. Insert CHITIETDONHANG
            // (DB bạn có trigger tự tính dongia + trừ tồn)
            foreach ($cartItems as $item) {
                DB::table('chitietdonhang')->insert([
                    'mahd'    => $madh,
                    'masp'    => $item->masp,
                    'soluong' => $item->soluong,
                    'dongia'  => 0,
                ]);
            }

            // 3. Xoá giỏ hàng
            DB::table('giohang')->where('matk', $matk)->delete();

            DB::commit();

            return redirect()->route('checkout.success')
                ->with('success',
                    "Cảm ơn bạn đã đặt hàng! Đơn $madh đã được ghi nhận, vui lòng chờ hệ thống xác nhận giao dịch."
                );
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi tạo đơn: ' . $e->getMessage());
        }
    }

    /**
     * GET /checkout/success
     */
    public function success()
    {
        return view('checkout_success');
    }
    public function showSelected(Request $request)
{
    // Nếu cart của bạn có tick chọn sản phẩm: nhận mảng/chuỗi masp từ form
    $maspList = $request->input('masp');

    // Có nơi gửi JSON string -> decode thử
    if (is_string($maspList)) {
        $decoded = json_decode($maspList, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $maspList = $decoded;
        }
    }

    // Nếu không tick gì thì mặc định thanh toán toàn bộ giỏ
    if (empty($maspList)) {
        return redirect()->route('checkout');
    }

    // Lưu danh sách đã chọn vào session để /checkout chỉ hiển thị đúng các món đã tick
    session(['checkout_masp' => $maspList]);

    return redirect()->route('checkout');
}

}
