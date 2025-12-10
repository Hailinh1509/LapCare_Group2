<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Product;
class PageController extends Controller
{
//Khai báo trang sản phẩm 

    public function news()
    {
        return view('pages.news');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function cart()
    {
        return view('pages.cart');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        // Check if user is admin
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('home.logged');
    }

    return back()->withErrors([
        'email' => 'Email hoặc mật khẩu không đúng.',
    ])->withInput();
}






public function products()
{
    // Lấy theo phân trang, ví dụ 9 sản phẩm / trang
    $products = Product::paginate(9)->withQueryString();

    // Thương hiệu
    $brands = [
        'Asus', 'Dell', 'HP', 'Lenovo',
        'MSI', 'Acer', 'Apple', 'Khác',
    ];

    // RAM
    $ramOptions = ['4GB', '8GB', '16GB', '32GB'];

    // Ổ cứng
    $ocungOptions = [
        '256GB SSD',
        '512GB SSD',
        '1TB SSD',
        '1TB HDD',
    ];

    // Màn hình  (⚠ dùng đúng tên $manhinhOptions như trong Blade)
    $manhinhOptions = [
        '13 inch',
        '14 inch',
        '15.6 inch',
        '17 inch',
    ];

    return view('pages.products', compact(
        'products',
        'brands',
        'ramOptions',
        'ocungOptions',
        'manhinhOptions',
    ));
}



    // ...

    public function detail($masp)
    {
        // Tìm sản phẩm theo mã SPxxx
        $product = Product::where('masp', $masp)->firstOrFail();

        // Mấy biến dưới đây là “chữa cháy” để detail.blade.php không bị lỗi undefined
        // (sau này bạn có bảng đánh giá thì thay bằng dữ liệu thật)
        $totalReviews = 0;
        $ratingCounts = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        return view('pages.detail', compact('product', 'totalReviews', 'ratingCounts'));
    }

    // ...




    // Các trang chính sách footer
    public function policyShipping()   { return view('pages.policy_shipping'); }
    public function policyWarranty()   { return view('pages.policy_warranty'); }
    public function policyReturn()     { return view('pages.policy_return'); }
    public function policyPrivacy()    { return view('pages.policy_privacy'); }
    public function policyDelivery()   { return view('pages.policy_delivery'); }
    public function policyRules()      { return view('pages.policy_rules'); }
}

