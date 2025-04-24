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
    // Định nghĩa số lượng đơn hàng hiển thị mỗi trang (dùng cho phân trang)
    const PER_PAGES = 10;

    /**
     * Hiển thị danh sách đơn hàng với tính năng tìm kiếm.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        // Tìm kiếm theo mã đơn hàng hoặc tên/email khách hàng
        if ($request->has('search')) {
            $search = $request->search;

            $query->where('order_id', 'LIKE', "%$search%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                });
        }

        // Phân trang và giữ lại tham số tìm kiếm khi chuyển trang
        $orders = $query->paginate(self::PER_PAGES)->appends($request->only('search'));
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết đơn hàng.
     */
    public function show($order_id)
    {
        // Lấy thông tin đơn hàng theo order_id
        $order = Order::findOrFail($order_id);
        return view('backend.order.show', compact('order'));
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     */
    public function edit($order_id)
    {

        $order = Order::findOrFail($order_id);
        return view('backend.order.edit', compact('order'));
    }

    /**
     * Cập nhật trạng thái đơn hàng và trạng thái thanh toán.
     */
    public function update(UpdateOrderRequest $request, $order_id)
    {
        try {
            DB::beginTransaction();

            // Lấy thông tin đơn hàng
            $order = Order::findOrFail($order_id);

            // Cập nhật trạng thái đơn hàng
            $order->status = $request->status;
            $order->save();

            // Cập nhật trạng thái và phương thức thanh toán nếu có
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
            // Ghi log lỗi để kiểm tra khi cần
            Log::error('Lỗi cập nhật đơn hàng: ' . $e->getMessage());

            return redirect()->route('order.index')->with('error', 'Cập nhật đơn hàng thất bại.');
        }
    }

    /**
     * Xóa đơn hàng, bao gồm chi tiết đơn và thanh toán nếu có.
     */
    public function destroy($order_id, Request $request)
    {
        try {
            DB::beginTransaction();

            // Tìm đơn hàng theo order_id
            $order = Order::findOrFail($order_id);

            // Xóa các bản ghi chi tiết đơn hàng liên quan
            $order->orderDetails()->delete();

            // Xóa thanh toán nếu có
            if ($order->payment) {
                $order->payment()->delete();
            }

            // Xóa đơn hàng chính
            $order->delete();

            DB::commit();

            $page = $request->get('page');
            return redirect()->route('order.index', ['page' => $page])->with('success', 'Đã xóa đơn hàng thành công.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('order.index')->with('error', 'Xóa đơn hàng thất bại: ' . $e->getMessage());
        }
    }
}
