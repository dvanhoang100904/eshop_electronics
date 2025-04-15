@extends('frontend.layouts.customer-layout')

@section('title', $product->name)

@section('content')
    <section class="mt-5 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none"
                                    href="{{ route('customer.product') }}"> Sản phẩm</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a class="text-decoration-none text-dark"
                                    href="{{ route('customer.category.products', $product->category->slug) }}">
                                    {{ $product->category->name }}
                                </a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <!-- image -->
                <div class="col-lg-6">
                    <img src="{{ asset('storage/' . $product->image) }}" class="d-block w-100" alt="{{ $product->name }}" />
                </div>
                <div class="col-lg-6">
                    <!-- name -->
                    <h1 class="mb-3">{{ $product->name }}</h1>
                    <!-- category -->
                    <p class="text-muted">{{ $product->category->name }}</p>
                    <!-- price -->
                    <p class="text-danger fw-bold h3">{{ number_format($product->price, 0, ',', '.') }} VND </p>
                    <!-- desc -->
                    <p class="lead">
                        {{ $product->description }}
                    </p>

                    <!-- Action -->
                    <!-- Action -->
                    <form action="{{ route('customer.addToCart') }}" method="POST" class="d-flex gap-3 mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}" />

                        <div class="input-group" style="width: 150px">
                            <button class="btn btn-outline-danger" type="button" onclick="changeQuantity(-1)">-</button>
                            <input type="number" class="form-control text-center" name="quantity"
                                id="product-quantity-input" value="1" min="1" required />
                            <button class="btn btn-outline-danger" type="button" onclick="changeQuantity(1)">+</button>
                        </div>

                        <button type="submit" class="btn btn-danger flex-grow-1">
                            <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                    </form>

                    <!-- Buy Now -->
                    <a href="{{ route('customer.cart') }}" class="btn btn-outline-danger w-100 mb-4">
                        <i class="fas fa-bolt me-2"></i>Mua ngay
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function changeQuantity(amount) {
            const input = document.getElementById('product-quantity-input');
            let value = parseInt(input.value) || 1;
            value += amount;
            if (value < 1) value = 1;
            input.value = value;
        }
    </script>
@endpush
