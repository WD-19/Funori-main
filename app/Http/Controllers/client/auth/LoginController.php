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
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // Kiểm tra role và chuyển hướng
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('client.dashboard');
        }

        return back()->withErrors(['login' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        // Lưu email vào session trước khi logout
        $email = Auth::user()->email ?? null;
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Lưu email vào session flash để hiển thị lại ở form login
        if ($email) {
            $request->session()->flash('last_email', $email);
        }

        return redirect()->route('client.login.index');
    }
}
