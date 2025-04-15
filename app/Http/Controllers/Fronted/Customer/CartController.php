<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a the cart page.
     */
    public function index()
    {
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng
        $cart = Cart::with('cartItems.product')->where(function ($q) use ($user_id, $session_id) {
            if ($user_id) {
                $q->where('user_id', $user_id);
            } else {
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

        return view('frontend.pages.carts', compact('cartItems', 'totalPrice'));
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user_id = auth()->check() ? auth()->id() : null;
        $session_id = session()->getId();

        // Tìm giỏ hàng của người dùng hoặc guest theo session
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id, 'session_id' => $session_id]
        );

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->cartItems()->where('product_id', $product_id)->first();

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

        return redirect()->route('customer.cart');
    }

    /**
     * Update the product quantity in the cart.
     */
    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

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
            $cartItem = $cart->cartItems()->where('product_id', $product_id)->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);

                // Tính lại tổng tiền
                $totalPrice = $cart->cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

                return redirect()->route('customer.cart')->with('totalPrice', $totalPrice);
            }
        }

        return back()->withErrors('Sản phẩm không có trong giỏ hàng!');
    }

    /**
     * Delete the product in the cart.
     */
    public function removeFromCart(Request $request)
    {
        $product_id = $request->input('product_id');

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
            $cartItem = $cart->cartItems()->where('product_id', $product_id)->first();

            if ($cartItem) {
                // Xóa sản phẩm khỏi giỏ
                $cartItem->delete();

                // Tính lại tổng tiền
                $totalPrice = $cart->cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

                return redirect()->route('customer.cart')->with('totalPrice', $totalPrice);
            }
        }

        return back()->withErrors('Sản phẩm không có trong giỏ hàng!');
    }
}
