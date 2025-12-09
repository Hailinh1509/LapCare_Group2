<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DanhGia;
use App\Models\GioHang;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // ============================================
    // ⭐ TRANG CHI TIẾT SẢN PHẨM
    // ============================================
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
            ->with('taikhoan')
            ->orderBy('ngaytao', 'desc');

        if (!empty($filterStar) && $filterStar !== 'all') {
            $reviewsQuery->where('rating', intval($filterStar));
        }

        // Phân trang
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

    // ============================================
    // ⭐ THÊM VÀO GIỎ HÀNG
    // ============================================
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
    $quantity = max(1, (int) $request->quantity);

    // Kiểm tra đăng nhập
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }

    // Kiểm tra sản phẩm có tồn tại
    $product = Product::where('masp', $product_id)->first();
    if (!$product) {
        return back()->with('error', 'Sản phẩm không tồn tại!');
    }

    // Kiểm tra sản phẩm đã trong giỏ chưa
    $existing = \App\Models\GioHang::where('matk', $user->id)   // hoặc $user->matk nếu cột tên khác
                ->where('masp', $product_id)
                ->first();

    if ($existing) {
        // Nếu đã có → tăng số lượng
        $existing->soluong += $quantity;
        $existing->save();

        return back()->with('success', 'Đã tăng số lượng sản phẩm trong giỏ hàng!');
    }

    // Nếu chưa có → thêm mới
    \App\Models\GioHang::create([
        'matk' => $user->id,  // hoặc tên cột tương ứng
        'masp' => $product_id,
        'soluong' => $quantity,
        'ngaychon' => now(),
    ]);

    // Lần đầu thêm → chuyển sang giỏ hàng
    return redirect('/cart')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // ============================================
    // ⭐ MUA NGAY
    // ============================================
    public function buyNow(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = max(1, (int) $request->quantity);

        $product = Product::where('masp', $product_id)->first();

        if (!$product) {
            return back()->with('error', 'Sản phẩm không tồn tại!');
        }

        session()->put('buy_now', [
            'product' => $product,
            'quantity' => $quantity
        ]);

        return redirect('/checkout');
    }

    // ============================================
    // ⭐ GỬI ĐÁNH GIÁ
    // ============================================
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

