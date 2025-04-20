<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        // Lấy user_id người dùng đã đăng nhập (nếu có), nếu không thì lấy session_id
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng hoặc của guest theo session
        $cart = Cart::with('cartItems.product')
            ->where(function ($q) use ($user_id, $session_id) {
                if ($user_id) {
                    $q->where('user_id', $user_id);
                } else {
                    // Nếu không có người dùng, tìm giỏ hàng của khách theo session
                    $q->where('session_id', $session_id);
                }
            })->first();

        // Nếu không có giỏ hàng, tạo mới
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user_id,
                'session_id' => $session_id,
            ]);
        }

        // Lấy các item trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Trả về trang giỏ hàng với các sản phẩm và tổng giá
        return view('frontend.pages.carts', compact('cartItems', 'totalPrice'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function addToCart(Request $request)
    {
        // Lấy thông tin sản phẩm và số lượng từ request
        $product_id = $request->input('product_id');

        // Mặc định số lượng là 1
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng hoặc của guest theo session
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id, 'session_id' => $session_id]
        );

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->cartItems()
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Nếu có, tăng số lượng lên
            $cartItem->increment('quantity', $quantity);
        } else {
            // Nếu chưa có, thêm mới vào giỏ
            $cart->cartItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        // Redirect lại trang giỏ hàng
        return redirect()->route('customer.cart');
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function updateCart(Request $request)
    {
        // Lấy thông tin sản phẩm và số lượng mới từ request
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Kiểm tra số lượng phải lớn hơn 0
        if ($quantity < 1) {
            return back()->withErrors('Số lượng phải lớn hơn 0!');
        }

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng hoặc guest theo session
        $cart = Cart::where(function ($q) use ($user_id, $session_id) {
            if ($user_id) {
                $q->where('user_id', $user_id);
            } else {
                $q->where('session_id', $session_id);
            }
        })->first();

        if ($cart) {
            // Tìm item trong giỏ hàng và cập nhật số lượng
            $cartItem = $cart->cartItems()
                ->where('product_id', $product_id)
                ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);

                // Tính lại tổng tiền của giỏ hàng
                $totalPrice = $cart->cartItems
                    ->sum(function ($item) {
                        return $item->product->price * $item->quantity;
                    });

                // Redirect lại trang giỏ hàng và truyền tổng giá mới
                return redirect()->route('customer.cart')->with('totalPrice', $totalPrice);
            }
        }

        return back()->withErrors('Sản phẩm không có trong giỏ hàng!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function removeFromCart(Request $request)
    {
        // Lấy product_id sản phẩm cần xóa
        $product_id = $request->input('product_id');

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng hoặc của guest theo session
        $cart = Cart::where(function ($q) use ($user_id, $session_id) {
            if ($user_id) {
                $q->where('user_id', $user_id);
            } else {
                $q->where('session_id', $session_id);
            }
        })->first();

        if ($cart) {
            // Tìm item trong giỏ hàng và xóa
            $cartItem = $cart->cartItems()
                ->where('product_id', $product_id)
                ->first();

            if ($cartItem) {
                // Xóa sản phẩm khỏi giỏ hàng
                $cartItem->delete();

                // Tính lại tổng tiền của giỏ hàng
                $totalPrice = $cart->cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

                // Redirect lại trang giỏ hàng và truyền tổng giá mới
                return redirect()->route('customer.cart')->with('totalPrice', $totalPrice);
            }
        }

        return back()->withErrors('Sản phẩm không có trong giỏ hàng!');
    }
}
