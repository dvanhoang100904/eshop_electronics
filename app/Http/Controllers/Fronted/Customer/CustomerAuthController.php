<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function login()
    {
        return view('frontend.pages.login');
    }

    public function authLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('customer.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('customer.login')->withErrors('Email hoặc Mật khẩu không chính xác');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('customer.login')->with('success', 'Đăng xuất thành công');
    }
}
