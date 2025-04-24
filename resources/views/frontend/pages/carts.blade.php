@extends('frontend.layouts.customer-layout')

@section('title', 'Trang giỏ hàng')

@section('content')
    @php
        $totalQuantity = $cartItems->sum('quantity');
    @endphp
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <!-- List products -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Giỏ Hàng Của Bạn ({{ $totalQuantity }} sản phẩm)</h4>
                            @forelse ($cartItems as $cartItem)
                                @if ($cartItem->product)
                                    <div class="row align-items-center mb-5">
                                        <!-- image -->
                                        <div class="col-md-2">
                                            <img src="{{ asset('storage/' . $cartItem->product->image) }}"
                                                class="img-fluid rounded" alt="{{ $cartItem->product->name }}" />
                                        </div>

                                        <!-- name -->
                                        <div class="col-md-4">
                                            <h6 class="mb-1">{{ $cartItem->product->name }}</h6>
                                            <small class="text-muted">Đơn giá:
                                                {{ number_format($cartItem->product->price, 2) }} VND</small>
                                        </div>

                                        <!-- quantity -->
                                        <div class="col-md-3 d-flex align-items-center">
                                            <!-- Giảm số lượng -->
                                            <form action="{{ route('customer.updateCart') }}" method="POST" class="me-1">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cartItem->product_id }}">
                                                <input type="hidden" name="quantity" value="{{ $cartItem->quantity - 1 }}">
                                                <button class="btn btn-outline-danger" type="submit"
                                                    {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>
                                                    -
                                                </button>
                                            </form>

                                            <!-- Hiển thị số lượng hiện tại -->
                                            <input type="text" class="form-control text-center"
                                                value="{{ $cartItem->quantity }}" readonly style="width: 50px" />

                                            <!-- Tăng số lượng -->
                                            <form action="{{ route('customer.updateCart') }}" method="POST"
                                                class="ms-1">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                    value="{{ $cartItem->product_id }}">
                                                <input type="hidden" name="quantity"
                                                    value="{{ $cartItem->quantity + 1 }}">
                                                <button class="btn btn-outline-danger" type="submit">+</button>
                                            </form>
                                        </div>

                                        <!-- price -->
                                        <div class="col-md-2">
                                            <p class="mb-0 fw-bold">
                                                {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }} VND
                                            </p>
                                        </div>

                                        <!-- action -->
                                        <div class="col-md-1">
                                            <form action="{{ route('customer.removeFromCart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                    value="{{ $cartItem->product_id }}">
                                                <button class="btn btn-link text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        Một sản phẩm trong giỏ hàng không còn tồn tại.
                                    </div>
                                @endif
                            @empty
                                <div class="alert alert-info text-center">
                                    Giỏ hàng của bạn hiện đang trống.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Tổng Kết Đơn Hàng</h5>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Tổng tiền:</p>
                                    <p class="mb-2">{{ number_format($totalPrice, 2) }} VND</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Giảm giá:</p>
                                    <p class="mb-2 text-success">0 VND</p>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2 fw-bold">Tổng thanh toán:</p>
                                    <p class="mb-2">{{ number_format($totalPrice, 2) }} VND</p>
                                </div>
                            </div>

                            @if ($cartItems->count())
                                <a href="{{ route('customer.checkout') }}" class="btn btn-danger w-100 mb-2">Đặt hàng</a>
                            @endif

                            <a href="{{ route('customer.product') }}" class="btn btn-checkout w-100 mb-2">Tiếp tục mua
                                sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
