<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController 
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // Kiểm tra role và chuyển hướng
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        }
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }
}
