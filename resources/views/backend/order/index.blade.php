@extends('backend.layouts.admin')

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
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0 fw-bold">
                    <i class="fas fa-shopping-cart me-2"></i>Danh Sách Đơn Hàng
                </h2>
            </div>

            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('order.index') }}?page={{ request()->get('page') }}" method="GET" class="w-100">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" name="search"
                            placeholder="Tìm kiếm đơn hàng..." value="{{ request()->search }}">
                        <button class="btn btn-primary" type="submit">Tìm</button>
                    </div>
                </form>
            </div>

            {{-- Orders Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="80" class="text-center">Mã</th>
                            <th>Khách Hàng</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Thanh Toán</th>
                            <th>Số Điện Thoại</th>
                            <th width="180" class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center fw-bold">#{{ $order->order_id }}</td>
                                <td>{{ $order->shippingAddress->name }}
                                    <br>
                                    <small class="text-muted">(Người Đặt: {{ $order->user->name }})</small>
                                </td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} <sup>VND</sup></td>
                                <td>
                                    <span class="badge bg-{{ $orderStatuses[$order->status]['color'] ?? 'secondary' }}">
                                        {{ $orderStatuses[$order->status]['label'] ?? $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->payment->method }}</td>
                                <td>
                                    {{ $order->shippingAddress->phone }}
                                    <br>
                                    <small class="text-muted">(SĐT người đặt: {{ $order->user->phone }})</small>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('order.show', $order->order_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-info" title="Xem" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('order.edit', $order->order_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-warning" title="Chỉnh sửa" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('order.destroy', $order->order_id) }}?page={{ request()->get('page') }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
                                                data-bs-toggle="tooltip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @include('backend.layouts.paginate', ['pagination' => $orders])
        </div>
    </div>
@endsection
