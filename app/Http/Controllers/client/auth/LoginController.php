<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController  // Sửa lại để kế thừa Controller
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
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ],
            'password' => 'required|min:6'
        ], [
            'email.regex' => 'Chỉ chấp nhận địa chỉ Gmail (@gmail.com).'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản
            if ($user->isBanned()) {
                Auth::logout();
                return back()->withErrors(['email&password' => 'Tài khoản của bạn đã bị khóa.'])->withInput();
            }
            if ($user->isInactive()) {
                Auth::logout();
                return back()->withErrors(['email&password' => 'Tài khoản của bạn chưa được kích hoạt.'])->withInput();
            }
            // Nếu không bị banned hoặc inactive, tức là active => cho phép đăng nhập

            // Kiểm tra role và chuyển hướng
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        }
        return back()->withErrors(['email&password' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('bot_token');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('client.login.index');
    }
}
