<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfCustomerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role_id === 2) {
                return redirect()->route('customer.index')->with('info', 'Bạn đã đăng nhập rồi');
            }

            if ($user->role_id === 1) {
                return redirect()->route('admin.dashboard')->with('info', 'Bạn đã đăng nhập rồi');
            }
        }

        return $next($request);
    }
}
