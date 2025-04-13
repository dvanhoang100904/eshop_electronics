<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            if (Auth::user()->role_id === 1) {
                Auth::logout();
                return redirect()->route('customer.login')->withErrors('Bạn không có quyền truy cập trang khách hàng.');
            }
            return redirect()->route('customer.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('customer.login')->withErrors('Email hoặc Mật khẩu không chính xác');
    }

    public function register()
    {
        return view('frontend.pages.register');
    }

    public function authRegister(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => 2
        ]);

        Auth::login($user);
        return redirect()->route('customer.index')->with('success', 'Chào mừng bạn, ' . $user->name . '! Đăng ký thành công.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('customer.login')->with('success', 'Đăng xuất thành công');
    }
}
