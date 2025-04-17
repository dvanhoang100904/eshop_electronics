<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();


        if ($request->has('search')) {
            $search = $request->search;
            $query->where('order_id', 'LIKE', "%$search%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                });
        }

        $perPage = 10;
        $orders = $query->paginate($perPage)->appends($request->only('search'));

        return view('backend.order.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('backend.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateOrderRequest $request, $order_id)
    {

        try {
            DB::beginTransaction();

            $order = Order::findOrFail($order_id);
            $order->status = $request->status;
            $order->save();

            // Cập nhật payment nếu tồn tại
            $payment = $order->payment;
            if ($payment) {
                $payment->status = $request->payment_status;
                $payment->method = $request->payment_method;
                $payment->save();
            }

            DB::commit();

            $page = $request->get('page');

            return redirect()->route('order.index', ['page' => $page])->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi cập nhật đơn hàng: ' . $e->getMessage());

            return redirect()->route('order.index')->with('error', 'Cập nhật đơn hàng thất bại.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order_id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($order_id);
            // Xoá các chi tiết đơn hàng liên quan
            $order->orderDetails()->delete();

            // Xoá thông tin thanh toán (nếu có)
            if ($order->payment) {
                $order->payment()->delete();
            }

            // Xoá chính đơn hàng
            $order->delete();

            DB::commit();

            return redirect()->route('order.index')->with('success', 'Đã xóa đơn hàng thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('order.index')->with('error', 'Xóa đơn hàng thất bại: ' . $e->getMessage());
        }
    }
}
