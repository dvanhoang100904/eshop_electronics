<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RequireCustomerLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('customer.login')->withErrors('Vui lòng đăng nhập');
        }

        if ($user->role_id !== 2) {
            return redirect()->route('customer.index')->withErrors('Bạn không phải là khách hàng để truy cập trang này!');
        }

        return $next($request);
    }
}
