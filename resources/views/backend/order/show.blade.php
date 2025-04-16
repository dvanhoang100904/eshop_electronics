@extends('backend.layouts.admin')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold mb-3">
            <i class="fas fa-shopping-cart me-2"></i> Chi tiết đơn hàng #{{ $order->order_id }}
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none text-dark"
                        href="{{ route('order.index') }}?page={{ request()->get('page') }}">
                        Quản lý đơn hàng
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết #{{ $order->order_id }}</li>
            </ol>
        </nav>
    </div>

    <!-- Thông tin đơn hàng -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-info-circle me-2"></i> Thông tin đơn hàng
        </div>
        <div class="card-body row">
            <div class="col-md-6">
                <p><strong>Mã đơn hàng:</strong> #{{ $order->order_id }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
            </div>
            <div class="col-md-6">
                <p><strong>Trạng thái đơn hàng:</strong> {{ $order->status }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->method }}</p>
                <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment->status }}</p>
            </div>
        </div>
    </div>

    <!-- Thông tin khách hàng -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-user me-2"></i> Thông tin khách hàng
        </div>
        <div class="card-body row">
            <div class="col-md-6">
                <p><strong>Tên khách hàng:</strong> {{ $order->shippingAddress->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Số điện thoại:</strong> {{ $order->shippingAddress->phone }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shippingAddress->address }}</p>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-box-open me-2"></i> Thông tin sản phẩm
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $orderDetail)
                        <tr class="text-center">
                            <td>
                                @if ($orderDetail->product)
                                    {{ $orderDetail->product->name }}
                                @else
                                    <span class="text-muted">[Đã xoá]</span>
                                @endif
                            </td>
                            <td>
                                @if ($orderDetail->product && $orderDetail->product->image)
                                    <img src="{{ asset('storage/' . $orderDetail->product->image) }}"
                                        alt="{{ $orderDetail->product->name }}" width="50" class="rounded border">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $orderDetail->quantity }}</td>
                            <td>{{ number_format($orderDetail->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($orderDetail->price * $orderDetail->quantity, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Tổng tiền:</th>
                        <th class="text-center">{{ number_format($order->total_price, 0, ',', '.') }} VND</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Nút hành động -->
    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('order.index') }}?page={{ request()->get('page') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
        <a href="{{ route('order.edit', $order->order_id) }}?page={{ request()->get('page') }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Chỉnh sửa
        </a>
    </div>
@endsection
