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
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
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
