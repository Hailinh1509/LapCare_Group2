<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DanhGia;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    // ============================================
    // ⭐ TRANG CHI TIẾT SẢN PHẨM: /products/{masp}
    // ============================================
    public function detail($masp, Request $request)
    {
        // Lấy 1 sản phẩm theo mã
        $product = Product::where('masp', $masp)->firstOrFail();

        // Lấy sản phẩm liên quan (cùng prefix mã loại)
        $prefix = substr($product->maloaisp, 0, 2);

        $related = Product::where('masp', '!=', $masp)
            ->whereRaw("LEFT(maloaisp, 2) = '$prefix'")
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // ⭐ LỌC THEO SỐ SAO
        $filterStar = $request->query('star'); 

        $reviewsQuery = DanhGia::where('masp', $masp)
            ->with('taikhoan')
            ->orderBy('ngaytao', 'desc');

        if (!empty($filterStar)) {
            $reviewsQuery->where('rating', $filterStar);
        }

        // ⭐ PHÂN TRANG REVIEW
        $reviews = $reviewsQuery->paginate(5)->withQueryString();

        // ⭐ THỐNG KÊ ĐÁNH GIÁ (dựa theo toàn bộ đánh giá)
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
    // ⭐ THÊM SẢN PHẨM VÀO GIỎ
    // ============================================
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = max(1, (int) $request->quantity);

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $product = Product::where('masp', $product_id)->first();
            if (!$product) {
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
            }

            $cart[$product_id] = [
                'masp' => $product->masp,
                'tensp' => $product->tensp,
                'gia' => $product->giasp,
                'hinhanh' => $product->hinhanh,
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
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
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        session()->put('buy_now', [
            'product' => $product,
            'quantity' => $quantity
        ]);

        return redirect('/checkout');
    }

    // ============================================
    // ⭐ THÊM ĐÁNH GIÁ
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
