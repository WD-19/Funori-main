<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckClientLogin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['user', 'admin'])) {
            return redirect()->route('client.login');
        }


        return $next($request);
    }
}
