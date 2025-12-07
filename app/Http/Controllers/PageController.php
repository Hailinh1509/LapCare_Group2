<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products()
    {
        return view('pages.products');
    }

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
        return redirect()->route('home.logged');
    }

    return back()->withErrors([
        'email' => 'Email hoặc mật khẩu không đúng.',
    ])->withInput();
}


    // Các trang chính sách footer
    public function policyShipping()   { return view('pages.policy_shipping'); }
    public function policyWarranty()   { return view('pages.policy_warranty'); }
    public function policyReturn()     { return view('pages.policy_return'); }
    public function policyPrivacy()    { return view('pages.policy_privacy'); }
    public function policyDelivery()   { return view('pages.policy_delivery'); }
    public function policyRules()      { return view('pages.policy_rules'); }
}

