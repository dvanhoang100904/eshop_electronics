@extends('frontend.layouts.customer-layout')

@section('title', 'Trang Sản Phẩm')

@section('content')
    <section class="mt-4">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                @include('frontend.pages.product.sidebar-filters')
                <div class="col-lg-9">
                    @include('frontend.pages.product.header-product')
                    <!-- List products -->
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 product-card">
                                    <div class="position-relative">
                                        <a class="text-dark text-decoration-none"
                                            href="{{ route('customer.product.show', $product->slug) }} ">
                                            <img src="{{ asset('storage/' . $product->name) }}"
                                                class="card-img-top product-img" alt="{{ $product->name }}" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <!-- name -->
                                        <a class="text-dark text-decoration-none"
                                            href="{{ route('customer.product.show', $product->slug) }}">
                                            <h5 class="card-title product-title">
                                                {{ $product->name }}
                                            </h5>
                                        </a>
                                        <!-- desc -->
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($product->description, 50) }}
                                        </p>
                                        <!-- price -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text product-price mb-0">
                                                {{ number_format($product->price, 0, ',', '.') }}
                                                VND
                                            </p>
                                        </div>
                                    </div>
                                    <!-- action -->
                                    <div class="card-footer bg-transparent border-top-0 pt-0">
                                        <a href="#!" class="btn btn-danger w-100 add-to-cart-btn">
                                            <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!--  Pagination -->
                    @if ($products->hasPages())
                        <div class="row mt-5">
                            <div class="col-12">
                                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                    <ul class="pagination">
                                        @if ($products->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link px-3 py-2 mx-1 rounded">&lsaquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link px-3 py-2 mx-1 rounded"
                                                    href="{{ $products->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                                            </li>
                                        @endif
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span
                                                        class="page-link px-3 py-2 mx-1 rounded">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link px-3 py-2 mx-1 rounded"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link px-3 py-2 mx-1 rounded"
                                                    href="{{ $products->nextPageUrl() }}" rel="next">&rsaquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link px-3 py-2 mx-1 rounded">&rsaquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
