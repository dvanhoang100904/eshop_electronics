@extends('frontend.layouts.customer-layout')

@section('title', 'Lịch sử đơn hàng')

@section('content')
    @php
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
        <h3 class="mb-4">Lịch sử đơn hàng của bạn</h3>

        @if ($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng tiền</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->order_id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                                <td>{{ strtoupper($order->payment->method) }}</td>
                                <td> <span class="badge bg-{{ $orderStatuses[$order->status]['color'] ?? 'secondary' }}">
                                        {{ $orderStatuses[$order->status]['label'] ?? $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.order.detail', $order->order_id) }}"
                                        class="btn btn-sm btn-outline-danger">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Bạn chưa có đơn hàng nào.</p>
        @endif
    </div>
@endsection
