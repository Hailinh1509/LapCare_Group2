<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DanhGia;
use Illuminate\Support\Facades\Auth;
use App\Models\GioHang;
use App\Models\User;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // ====================================================
    // ⭐ TRANG CHI TIẾT SẢN PHẨM
    // ====================================================
    public function detail($masp, Request $request)
    {
        // Lấy sản phẩm theo mã
        $product = Product::where('masp', $masp)->firstOrFail();

        // Sản phẩm liên quan
        $prefix = substr($product->maloaisp, 0, 2);
        $related = Product::where('masp', '!=', $masp)
            ->whereRaw("LEFT(maloaisp, 2) = '$prefix'")
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // ⭐ Lọc theo số sao
        $filterStar = $request->query('star');

        $reviewsQuery = DanhGia::where('masp', $masp)
            ->with('User')
            ->orderBy('ngaytao', 'desc');

        if (!empty($filterStar) && $filterStar !== 'all') {
            $reviewsQuery->where('rating', intval($filterStar));
        }

        // Phân trang đánh giá
        $reviews = $reviewsQuery->paginate(5)->withQueryString();

        // ⭐ Thống kê rating
        $allReviews = DanhGia::where('masp', $masp)->get();

        $avgRating = round($allReviews->avg('rating'), 1);

        $ratingCounts = [
            5 => $allReviews->where('rating', 5)->count(),
            4 => $allReviews->where('rating', 4)->count(),
            3 => $allReviews->where('rating', 3)->count(),
            2 => $allReviews->where('rating', 2)->count(),
            1 => $allReviews->where('rating', 1)->count(),
        ];

        $totalReviews = $allReviews->count();

        return view('pages.detail', compact(
            'product',
            'related',
            'reviews',
            'avgRating',
            'ratingCounts',
            'totalReviews',
            'filterStar'
        ));
    }

    // ====================================================
    // ⭐ THÊM SẢN PHẨM VÀO GIỎ
    // ====================================================
// ================== THÊM SẢN PHẨM VÀO GIỎ ==================
public function addToCart(Request $request)
{
    // 1. BẮT BUỘC ĐĂNG NHẬP
    if (!Auth::check()) {
        return redirect()
            ->route('login')
            ->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
    }

    // 2. LẤY USER HIỆN TẠI
    $user = Auth::user();

    // Nếu user chưa có mã tài khoản -> tự tạo (VD: TK007) rồi lưu lại
    if (empty($user->matk)) {
        $user->matk = 'TK' . str_pad($user->id, 3, '0', STR_PAD_LEFT);
        $user->save();
    }

    $matk = $user->matk;   // lúc này chắc chắn KHÔNG null

    // 3. LẤY MÃ SẢN PHẨM & SỐ LƯỢNG TỪ REQUEST
    // Ưu tiên lấy 'masp', nếu ko có thì thử 'product_id'
    $product_id = $request->input('masp', $request->input('product_id'));
    $quantity   = $request->input('soluong', $request->input('quantity', 1));

    // Nếu vẫn không có mã sản phẩm -> trả về báo lỗi
    if (empty($product_id)) {
        return back()->with('error', 'Không xác định được sản phẩm để thêm vào giỏ hàng.');
    }

    // 4. KIỂM TRA ĐÃ CÓ SP NÀY TRONG GIỎ CHƯA
    $existing = GioHang::where('matk', $matk)
                       ->where('masp', $product_id)
                       ->first();

    if ($existing) {
        // Tăng số lượng
        $existing->soluong += $quantity;
        $existing->save();
    } else {
        // Thêm mới
        GioHang::create([
            'matk'     => $matk,
            'masp'     => $product_id,
            'soluong'  => $quantity,
            'ngaychon' => now(),
        ]);
    }

    // 5. CHUYỂN VỀ TRANG GIỎ HÀNG
    return redirect()
        ->route('cart.index')
        ->with('success', 'Đã thêm vào giỏ hàng!');
}



    // ====================================================
    // ⭐ GỬI ĐÁNH GIÁ
    // ====================================================
    public function addReview(Request $request, $masp)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'noidung' => 'required|string|max:500',
        ]);

        DanhGia::create([
            'matk' => auth()->user()->matk,
            'masp' => $masp,
            'noidung' => $request->noidung,
            'rating' => $request->rating,
            'ngaytao' => now(),
        ]);

        return back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }
}
