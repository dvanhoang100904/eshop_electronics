@extends('frontend.layouts.customer-layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    @php
        $paymentStatuses = [
            'đang_chờ' => [
                'label' => 'Đang chờ',
                'color' => 'secondary',
            ],
            'đã_thanh_toán' => [
                'label' => 'Đã thanh toán',
                'color' => 'success',
            ],
            'thất_bại' => [
                'label' => 'Thất bại',
                'color' => 'danger',
            ],
            'đã_hoàn_tiền' => [
                'label' => 'Đã hoàn tiền',
                'color' => 'info',
            ],
        ];

        $orderStatuses = [
            'chờ_xử_lý' => [
                'label' => 'Chờ xử lý',
                'color' => 'secondary',
            ],
            'đang_xử_lý' => [
                'label' => 'Đang xử lý',
                'color' => 'warning',
            ],
            'đang_vận_chuyển' => [
                'label' => 'Đang vận chuyển',
                'color' => 'primary',
            ],
            'đã_giao_hàng' => [
                'label' => 'Đã giao hàng',
                'color' => 'success',
            ],
            'đã_hủy' => [
                'label' => 'Đã hủy',
                'color' => 'danger',
            ],
        ];
    @endphp
    <div class="container py-5">
        <h3 class="mb-4">Chi tiết đơn hàng #{{ $order->order_id }}</h3>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Thông tin đơn hàng</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng thái đơn hàng:</strong>
                            <span class="badge bg-{{ $orderStatuses[$order->status]['color'] ?? 'secondary' }}">
                                {{ $orderStatuses[$order->status]['label'] ?? $order->status }}
                            </span>
                        </p>
                        <p><strong>Trạng thái thanh toán:</strong>
                            <span class="badge bg-{{ $paymentStatuses[$order->payment->status]['color'] ?? 'secondary' }}">
                                {{ $paymentStatuses[$order->payment->status]['label'] ?? $order->payment->status }}
                            </span>
                        </p>
                        <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment->method) }}</p>
                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}VND</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Địa chỉ giao hàng</h5>
                        <p><strong>Tên người nhận:</strong> {{ $order->shippingAddress->name }}</p>
                        <p><strong>Địa chỉ: </strong> {{ $order->shippingAddress->address }}</p>
                        <p><strong>Phone:</strong> {{ $order->shippingAddress->phone }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p><strong>Ghi chú:</strong> {{ $order->notes }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Chi tiết sản phẩm</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $orderDetail)
                                <tr>
                                    <td>
                                        <img src="{{ $orderDetail->product->image }}"
                                            alt="{{ $orderDetail->product->name }}" class="img-fluid"
                                            style="max-width: 80px;">
                                    </td>
                                    <td>{{ $orderDetail->product->name }}</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>{{ number_format($orderDetail->price, 0, ',', '.') }} VND</td>
                                    <td>{{ number_format($orderDetail->quantity * $orderDetail->price, 0, ',', '.') }} VND
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary mt-4">Quay lại lịch sử đơn hàng</a>
    </div>
@endsection
