<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập admin
     */
    public function login()
    {
        return view('backend.auth.login');
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function authLogin(LoginRequest $request)
    {
        // Lấy email và password từ form
        $credentials = $request->only('email', 'password');

        // Kiểm tra đăng nhập với thông tin đã nhập
        if (Auth::attempt($credentials)) {
            // Nếu đăng nhập thành công, kiểm tra role
            if (Auth::user()->role_id !== 1) {
                // Nếu không phải admin thì đăng xuất ngay
                Auth::logout();
                return redirect()->route('admin.login')->withErrors('Bạn không có quyền truy cập.');
            }

            // Nếu đúng là admin thì chuyển hướng đến dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }

        // Nếu thông tin không đúng, quay lại form
        return redirect()->route('admin.login')->withErrors('Email hoặc Mật khẩu không chính xác');
    }

    /**
     * Xử lý đăng xuất admin
     */
    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Hủy session hiện tại
        $request->session()->invalidate();

        // Tạo lại token mới để tránh CSRF
        $request->session()->regenerateToken();

        // Chuyển hướng về trang đăng nhập 
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');
    }
}
