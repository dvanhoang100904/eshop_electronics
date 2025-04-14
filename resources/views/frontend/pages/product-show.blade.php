@extends('frontend.layouts.customer-layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- Link tới trang sản phẩm -->
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark" href="{{ route('customer.product') }}">Sản phẩm</a>
                        </li>

                        <!-- Link tới danh mục sản phẩm -->
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('customer.category.products', $product->category->slug) }}">
                                {{ $product->category->name }}
                            </a>
                        </li>

                        <!-- Tên sản phẩm hiện tại -->
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
                <div class="d-flex gap-3 mb-4">
                    <div class="input-group" style="width: 150px">
                        <button class="btn btn-outline-danger" type="button">-</button>
                        <input type="number" class="form-control text-center" value="1" min="1" />
                        <button class="btn btn-outline-danger" type="button">+</button>
                    </div>
                    <a href="#!" class="btn btn-danger flex-grow-1">
                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                    </a>
                </div>

                <!-- Buy Now -->
                <a href="./cart.html" class="btn btn-outline-danger w-100 mb-4">
                    <i class="fas fa-bolt me-2"></i>Mua ngay
                </a>
            </div>
        </div>
    </div>
@endsection
