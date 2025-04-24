@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('order.index') }}?page={{ request()->get('page') }}">
                                Đơn Hàng
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chỉnh Sửa #{{ $order->order_id }}
                        </li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Cập Nhật Đơn Hàng</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('order.update', $order->order_id) }}?page={{ request()->get('page') }}"
                    method="POST" class="card shadow">
                    @csrf
                    @method('PUT')

                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Đơn Hàng</h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">Trạng thái đơn hàng <span
                                    class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select form-select-lg" required>
                                <option value="chờ_xử_lý"
                                    {{ old('status', $order->status) == 'chờ_xử_lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="đang_xử_lý"
                                    {{ old('status', $order->status) == 'đang_xử_lý' ? 'selected' : '' }}>Đang xử lý
                                </option>
                                <option value="đang_vận_chuyển"
                                    {{ old('status', $order->status) == 'đang_vận_chuyển' ? 'selected' : '' }}>Đang vận
                                    chuyển
                                </option>
                                <option value="đã_giao_hàng"
                                    {{ old('status', $order->status) == 'đã_giao_hàng' ? 'selected' : '' }}>
                                    Đã giao</option>
                                <option value="đã_hủy" {{ old('status', $order->status) == 'đã_hủy' ? 'selected' : '' }}>Đã
                                    hủy</option>
                            </select>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="payment_status" class="form-label fw-bold">Trạng thái thanh toán <span
                                    class="text-danger">*</span></label>
                            <select name="payment_status" id="payment_status" class="form-select form-select-lg" required>
                                <option value="đang_chờ"
                                    {{ old('payment_status', $order->payment->status) == 'đang_chờ' ? 'selected' : '' }}>
                                    Đang chờ</option>
                                <option value="đã_thanh_toán"
                                    {{ old('payment_status', $order->payment->status) == 'đã_thanh_toán' ? 'selected' : '' }}>
                                    Đã thanh toán</option>
                                <option value="đã_hủy"
                                    {{ old('payment_status', $order->payment->status) == 'đã_hủy' ? 'selected' : '' }}>Đã
                                    hủy</option>
                            </select>
                            @if ($errors->has('payment_status'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('payment_status') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="payment_method" class="form-label fw-bold">Phương thức thanh toán <span
                                    class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-select form-select-lg" required>
                                <option value="COD"
                                    {{ old('payment_method', $order->payment->method) == 'COD' ? 'selected' : '' }}>COD
                                </option>
                                <option value="MoMo"
                                    {{ old('payment_method', $order->payment->method) == 'MoMo' ? 'selected' : '' }}>MoMo
                                </option>
                            </select>
                            @if ($errors->has('payment_method'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('payment_method') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between">
                        <a href="{{ route('order.index') }}?page={{ request()->get('page') }}"
                            class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Quay Lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
