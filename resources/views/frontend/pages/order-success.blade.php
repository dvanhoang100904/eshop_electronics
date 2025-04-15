@extends('frontend.layouts.customer-layout')

@section('content')
    <div class="container py-5">
        <div class="text-center">
            <h2 class="text-success mb-3">🎉 Đặt hàng thành công!</h2>
            <p>Cảm ơn bạn đã mua hàng. Mã đơn hàng của bạn là <strong>#{{ $order->order_id }}</strong></p>
            <p>Tổng tiền: <strong>{{ number_format($order->total_price, 0, ',', '.') }} VND</strong></p>
            <p>Phương thức thanh toán: <strong>{{ ucfirst($order->payment->method) }}</strong></p>
            <p>Trạng thái đơn hàng: <strong>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</strong></p>

            <h4 class="mt-4">Chi tiết đơn hàng</h4>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($detail->total_price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('customer.orders') }}" class="btn btn-danger mt-3">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
