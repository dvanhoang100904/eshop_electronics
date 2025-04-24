@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-3 fw-bold">
                <i class="fas fa-cube me-2"></i> Chi tiết Sản Phẩm
            </h2>
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-dark "
                            href="{{ route('product.index') }}?page={{ request()->get('page') }}">Sản Phẩm</a></li>
                    <li class="breadcrumb-item active " aria-current="page">Chi Tiết #{{ $product->product_id }}</li>
                </ol>
            </nav>

        </div>
    </div>

    <div class="row">
        <!-- Thông tin chính -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i> Thông tin cơ bản
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Mã sản phẩm -->
                                <tr>
                                    <td class="fw-bold text-muted" width="25%">Mã sản phẩm:</td>
                                    <td>
                                        <span class="badge bg-light text-dark fs-6">#{{ $product->product_id }}</span>
                                    </td>
                                </tr>
                                <!-- Tên sản phẩm -->
                                <tr>
                                    <td class="fw-bold text-muted">Tên sản phẩm:</td>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                </tr>
                                <!-- Danh mục -->
                                <tr>
                                    <td class="fw-bold text-muted">Danh mục:</td>
                                    <td>
                                        @if ($product->category)
                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">Chưa phân loại</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Giá -->
                                <tr>
                                    <td class="fw-bold text-muted">Giá bán:</td>
                                    <td>
                                        <span class="fw-bold text-danger fs-5">
                                            {{ number_format($product->price, 0, ',', '.') }} VND
                                        </span>
                                    </td>
                                </tr>

                                {{-- featured --}}
                                <tr>
                                    <td class="fw-bold text-muted">Sản Phẩm nổi bật:</td>
                                    <td>
                                        <span class="fw-bold text-danger fs-5">
                                            {{ $product->is_featured ? 'Nổi bật' : 'Không nổi bật' }}
                                        </span>
                                    </td>
                                </tr>

                                <!-- Ngày tạo -->
                                <tr>
                                    <td class="fw-bold text-muted">Ngày tạo:</td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $product->created_at->format('d/m/Y H:i') }}
                                        <small class="text-muted">({{ $product->created_at->diffForHumans() }})</small>
                                    </td>
                                </tr>

                                <!-- Cập nhật cuối -->
                                <tr>
                                    <td class="fw-bold text-muted">Cập nhật cuối:</td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $product->updated_at->format('d/m/Y H:i') }}
                                        <small class="text-muted">({{ $product->updated_at->diffForHumans() }})</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-align-left me-2"></i> Mô tả sản phẩm
                    </h5>
                </div>
                <div class="card-body">
                    <div class="product-description ">
                        {!! $product->description ?: '<p class="text-muted fst-italic">Chưa có mô tả</p>' !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Hình ảnh sản phẩm -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-image me-2"></i> Hình ảnh
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="product-image-container mb-3">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png') }}"
                            class="img-fluid rounded border" alt="{{ $product->name }}"
                            style="max-height: 300px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action button -->
    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('product.index') }}?page={{ request()->get('page') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>

        <a href="{{ route('product.edit', $product->product_id) }}?page={{ request()->get('page') }}"
            class="btn btn-warning">
            <i class="fas fa-edit"></i> Chỉnh sửa
        </a>
    </div>
@endsection
