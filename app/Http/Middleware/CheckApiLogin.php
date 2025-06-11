<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckApiLogin
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        // Kiểm tra header Authorization có tồn tại và đúng định dạng không
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token không hợp lệ'], 401);
        }

        // Trích xuất token từ header
        $token = substr($authHeader, 7);

        // Kiểm tra xem token có tồn tại trong cơ sở dữ liệu không
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn'], 401);
        }

        // Gán thông tin người dùng đã xác thực vào request để sử dụng trong controller
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
