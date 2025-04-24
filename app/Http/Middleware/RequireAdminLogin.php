<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RequireAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->withErrors('Vui lòng đăng nhập để truy cập trang quản trị!');
        }

        if (Auth::user()->role_id !== 1) {
            return redirect()->route('customer.login')->withErrors('Bạn không có quyền truy cập vào trang quản trị!');
        }
        return $next($request);
    }
}
