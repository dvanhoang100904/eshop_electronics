<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Trang thanh toán
    public function checkout()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->withErrors('Giỏ hàng của bạn đang trống hoặc không tồn tại.');
        }

        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product ? $item->product->price * $item->quantity : 0;
        });

        return view('frontend.pages.checkout', compact('cartItems', 'totalPrice'));
    }

    // Xử lý đặt hàng (place order)
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->withErrors('Không thể đặt hàng vì giỏ hàng của bạn đang trống.');
        }

        $cartItems = $cart->cartItems;

        DB::beginTransaction();
        try {
            // Tính toán tổng giá trị đơn hàng
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->product ? $item->product->price * $item->quantity : 0;
            });

            // Lưu thông tin địa chỉ giao hàng
            $shippingAddress = ShippingAddress::create([
                'user_id' => $user->user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->user_id,
                'total_price' => $totalPrice,
                'status' => 'chờ_xử_lý',
                'shipping_address_id' => $shippingAddress->shipping_address_id,
                'notes' => $request->notes,
            ]);

            // Lưu chi tiết đơn hàng
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'total_price' => $item->product->price * $item->quantity,  // Lưu tổng giá cho mỗi sản phẩm
                ]);
            }

            // Xóa giỏ hàng
            $cart->cartItems()->delete();
            // Xóa giỏ hàng của người dùng
            $cart->delete();

            // Tạo thông tin thanh toán
            Payment::create([
                'order_id' => $order->order_id,
                'method' => $request->paymentMethod,
                'status' => 'đang_chờ',
            ]);

            DB::commit();

            return redirect()->route('customer.order.success', $order->order_id); // Chuyển đến trang thành công
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi đặt hàng: ' . $e->getMessage());
            return back()->withErrors('Đặt hàng thất bại, vui lòng thử lại.');
        }
    }

    public function orderSuccess($order_id)
    {
        $order = Order::with('orderDetails.product', 'shippingAddress')
            ->where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return view('frontend.pages.order-success', compact('order'));
    }

    public function orderHistory()
    {
        $user = Auth::user();

        $orders = Order::with('shippingAddress')
            ->where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.pages.order-history', compact('orders'));
    }

    public function orderDetail($orderId)
    {
        $user = Auth::user();

        // Lấy thông tin đơn hàng của người dùng, bao gồm chi tiết sản phẩm
        $order = Order::with('orderDetails.product', 'shippingAddress')
            ->where('user_id', $user->user_id)
            ->where('order_id', $orderId)
            ->first();
        if (!$order) {
            return redirect()->route('customer.orders')->withErrors('Đơn hàng không tồn tại.');
        }

        return view('frontend.pages.order-detail', compact('order'));
    }
}
