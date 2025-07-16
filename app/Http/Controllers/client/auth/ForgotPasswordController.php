<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController
{
    public function show()
    {
        return view('client.auth.forgot-password');
    }

    public function send(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Hãy kiểm tra email bạn!');
        } else {
            return back()->withErrors(['email' => 'Không tìm thấy email. Vui lòng kiểm tra lại!'])->withInput();
        }
    }
}
