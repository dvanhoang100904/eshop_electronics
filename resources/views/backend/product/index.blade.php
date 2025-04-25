@php
    use Illuminate\Support\Str;
@endphp

@extends('backend.layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0 fw-bold">
                    <i class="fas fa-boxes me-2"></i>Danh Sách Sản Phẩm
                </h2>
                <a href="{{ route('product.create') }}?page={{ request()->get('page') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Thêm
                </a>
            </div>

            <!-- Bộ lọc -->
            <form action="{{ route('product.index') }}" method="GET" class="row g-3 mb-4">
                {{-- Ô tìm kiếm --}}
                <div class="col-md-4">
                    <label class="form-label">Từ khóa</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" name="search"
                            placeholder="Tìm kiếm sản phẩm..." value="{{ request()->search }}">
                    </div>
                </div>

                {{-- Danh mục --}}
                <div class="col-md-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select">
                        <option value="">Tất cả</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Trạng thái nổi bật --}}
                <div class="col-md-2">
                    <label class="form-label">Nổi bật</label>
                    <select name="is_featured" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Không</option>
                    </select>
                </div>

                {{-- Nút lọc --}}
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="fas fa-filter me-1"></i> Lọc
                    </button>
                </div>
            </form>


            {{-- Products Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="80" class="text-center">Mã</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th width="120" class="text-end">Giá</th>
                            <th width="160">Hình ảnh</th>
                            <th width="180" class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="text-center fw-bold">#{{ $product->product_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    {{ Str::limit($product->description, 20) }}
                                    @if (Str::length($product->description) > 20)
                                        <a href="{{ route('product.show', $product->product_id) }}?page={{ request()->get('page') }}"
                                            class="text-decoration-none">…</a>
                                    @endif
                                </td>
                                <td class="text-end">{{ number_format($product->price, 0, ',', '.') }} VND</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-thumbnail" width="80" height="80" style="object-fit: cover;">
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('product.show', $product->product_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-info" title="Xem" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('product.edit', $product->product_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-warning" title="Chỉnh sửa" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('product.destroy', $product->product_id) }}?page={{ request()->get('page') }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
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
            @include('backend.layouts.paginate', ['pagination' => $products])
        </div>
    </div>
@endsection
