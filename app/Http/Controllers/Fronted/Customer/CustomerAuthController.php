<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function login()
    {
        return view('frontend.pages.login');
    }

    /**
     * Xử lý đăng nhập.
     */
    public function authLogin(LoginRequest $request)
    {
        // Lưu lại session_id trước khi login
        $session_id = $request->session()->getId();

        // Lấy thông tin đăng nhập từ form
        $credentials = $request->only('email', 'password');

        // Nếu thông tin đăng nhập chính xác
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra nếu người dùng có role_id = 1 (admin)
            if ($user->role_id === 1) {
                // Đăng xuất người dùng admin
                Auth::logout();
                return redirect()->route('customer.login')->withErrors('Bạn không có quyền truy cập trang khách hàng.');
            }

            // Tìm giỏ hàng của session (guest)
            $guestCart = Cart::where('session_id', $session_id)
                ->whereNull('user_id')
                ->first();

            if ($guestCart) {
                // Tìm hoặc tạo giỏ hàng của user
                $userCart = Cart::firstOrCreate(['user_id' => $user->user_id]);

                foreach ($guestCart->cartItems as $item) {
                    $existingItem = $userCart->cartItems()
                        ->where('product_id', $item->product_id)
                        ->first();

                    if ($existingItem) {
                        $existingItem->increment('quantity', $item->quantity);
                    } else {
                        $userCart->cartItems()->create([
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                        ]);
                    }
                }

                // Xóa giỏ hàng guest
                $guestCart->cartItems()->delete();
                $guestCart->delete();
            }

            // Đăng nhập thành công và chuyển hướng tới trang chính của khách hàng
            return redirect()->route('customer.index')->with('success', 'Đăng nhập thành công');
        }

        // Nếu thông tin đăng nhập sai thì chuyển hướng tới trang đăng nhập
        return redirect()->route('customer.login')->withErrors('Email hoặc Mật khẩu không chính xác');
    }

    /**
     *  Hiển thị trang đăng ký.
     */
    public function register()
    {
        return view('frontend.pages.register');
    }

    /**
     *  Xử lý đăng ký người dùng mới.
     */
    public function authRegister(RegisterRequest $request)
    {
        // Lưu lại session_id trước khi đăng ký
        $session_id = $request->session()->getId();

        // Tạo mới người dùng và gán vai trò khách hàng (role_id = 2)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => 2
        ]);

        // Đăng nhập ngay lập tức sau khi đăng ký
        Auth::login($user);

        // Tìm giỏ hàng của session (guest)
        $guestCart = Cart::where('session_id', $session_id)
            ->whereNull('user_id')
            ->first();

        if ($guestCart) {
            // Tìm hoặc tạo giỏ hàng của user
            $userCart = Cart::firstOrCreate(['user_id' => $user->user_id]);

            foreach ($guestCart->cartItems as $item) {
                $existingItem = $userCart->cartItems()
                    ->where('product_id', $item->product_id)
                    ->first();

                if ($existingItem) {
                    $existingItem->increment('quantity', $item->quantity);
                } else {
                    $userCart->cartItems()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                    ]);
                }
            }

            // Xóa giỏ hàng guest
            $guestCart->cartItems()->delete();
            $guestCart->delete();
        }

        // Chuyển hướng người dùng tới trang chủ với thông báo thành công
        return redirect()->route('customer.index')->with('success', 'Chào mừng bạn, ' . $user->name . '! Đăng ký thành công.');
    }

    /**
     * Xử lý đăng xuất.
     */
    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Xóa thông tin phiên làm việc
        $request->session()->invalidate();

        // Tạo lại token session để bảo mật
        $request->session()->regenerateToken();

        // Chuyển hướng người dùng tới trang đăng nhập với thông báo đăng xuất thành công
        return redirect()->route('customer.login')->with('success', 'Đăng xuất thành công');
    }
}
