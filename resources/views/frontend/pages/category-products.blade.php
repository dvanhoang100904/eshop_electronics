@extends('frontend.layouts.customer-layout')

@section('title', $category->name)

@section('content')
    <div class="container py-4">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('customer.index') }}"><i
                            class="fas fa-home text-danger"></i> Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="h4 fw-bold mb-0">
                <i class="fas fa-tag me-2 text-danger"></i>
                {{ $category->name }}
            </h2>
            <span class="badge bg-danger rounded-pill">{{ $products->total() }} sản phẩm</span>
        </div>

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="ratio ratio-1x1">
                            <a class="text-dark text-decoration-none"
                                href="{{ route('customer.product.show', $product->slug) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top object-fit-cover"
                                    alt="{{ $product->name }}" loading="lazy">
                            </a>

                        </div>
                        <div class="card-body d-flex flex-column">
                            <a class="text-dark text-decoration-none"
                                href="{{ route('customer.product.show', $product->slug) }}">
                                <h5 class="card-title fs-6 mb-2">{{ Str::limit($product->name, 50) }}</h5>
                            </a>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                {{ Str::limit($product->description, 50) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Không có sản phẩm nào trong danh mục này.
                    </div>
                </div>
            @endforelse
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
                                    <a class="page-link px-3 py-2 mx-1 rounded" href="{{ $products->previousPageUrl() }}"
                                        rel="prev">&lsaquo;</a>
                                </li>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link px-3 py-2 mx-1 rounded">{{ $page }}</span>
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
                                    <a class="page-link px-3 py-2 mx-1 rounded" href="{{ $products->nextPageUrl() }}"
                                        rel="next">&rsaquo;</a>
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
@endsection
