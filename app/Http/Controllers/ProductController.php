<?php


namespace App\Http\Controllers;


use App\Models\sanpham;
use App\Models\danhgia;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function detail($masp)
    {
        // Lấy sản phẩm
        //$product = sanpham::with('loai')->find($masp)->firstOrFail();;
         $product = SanPham::where('masp', $masp)->firstOrFail();
        if (!$product) {
            abort(404, 'Không tìm thấy sản phẩm');
        }


        // Lấy sản phẩm liên quan
        $prefix = substr($product->maloaisp, 0, 2);


        $related = sanpham::where('masp', '!=', $masp)
            ->whereRaw("LEFT(maloaisp, 2) = '$prefix'")
            ->inRandomOrder()
            ->limit(4)
            ->get();


       
        // ===== Lấy đánh giá của sản phẩm =====
        $reviews = danhgia::where('masp', $masp)
            ->with('taikhoan')
            ->orderBy('ngaytao', 'desc')
            ->paginate(5);       // 5 bình luận / trang


        //return view('detail', compact('product', 'related', 'reviews'));
       // $reviews = DanhGia::where('masp', $masp)->get();


    // Trung bình sao
        $avgRating = $reviews->avg('rating');


    // Làm tròn đến 1 chữ số thập phân
        $avgRating = round($avgRating, 1);


    // Đếm số lượng theo từng sao
    $ratingCounts = [
        5 => $reviews->where('rating', 5)->count(),
        4 => $reviews->where('rating', 4)->count(),
        3 => $reviews->where('rating', 3)->count(),
        2 => $reviews->where('rating', 2)->count(),
        1 => $reviews->where('rating', 1)->count(),
    ];


$totalReviews = $reviews->count();
return view('detail', compact(
    'product',
    'related',
    'reviews',
    'avgRating',
    'ratingCounts',
    'totalReviews'
));


    }


    // Thêm sản phẩm vào giỏ
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = (int) $request->quantity;


        if ($quantity < 1) $quantity = 1;


        // Lấy giỏ hiện tại
        $cart = session()->get('cart', []);


        // Nếu sản phẩm đã có, tăng số lượng
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Lấy thông tin sản phẩm
            $product = sanpham::where('masp', $product_id)->first();


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


    // Mua ngay
    public function buyNow(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = (int) $request->quantity;


        if ($quantity < 1) $quantity = 1;


        $product = sanpham::where('masp', $product_id)->first();


        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }


        session()->put('buy_now', [
            'product' => $product,
            'quantity' => $quantity
        ]);


        return redirect('/checkout');
    }
    //thêm đánh giá
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



