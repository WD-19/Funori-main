<?php
namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController
{
    public function show(Request $request, $token = null)
    {
        return view('client.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Thiếu mã xác thực!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập mật khẩu mới!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp!',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('client.login')->with('success', 'Đặt lại mật khẩu thành công!')
            : back()->withErrors(['email' => 'Có lỗi xảy ra hoặc liên kết đã hết hạn. Vui lòng thử lại!']);
    }
}
