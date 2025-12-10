<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.password-change');
    }

    public function change(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}
