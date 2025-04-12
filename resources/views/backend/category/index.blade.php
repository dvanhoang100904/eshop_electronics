@php
    use Illuminate\Support\Str;
@endphp

@extends('backend.layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0 fw-bold">
                    <i class="fas fa-list me-2"></i>Danh Sách Danh Mục
                </h2>
                <a href="{{ route('category.create') }}?page={{ request()->get('page') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Thêm
                </a>
            </div>

            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('category.index') }}?page={{ request()->get('page') }}" method="GET" class="w-100">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" name="search"
                            placeholder="Tìm kiếm người dùng..." value="{{ request()->search }}">
                        <button class="btn btn-primary" type="submit">Tìm</button>
                    </div>
                </form>
            </div>

            {{-- Categories Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="80" class="text-center">Mã</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th width="120">Hình ảnh</th>
                            <th width="180" class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center fw-bold">{{ $category->category_id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{ Str::limit($category->description, 20) }}
                                    @if (Str::length($category->description) > 20)
                                        <a href="{{ route('category.show', $category->category_id) }}?page={{ request()->get('page') }}"
                                            class="text-decoration-none">…</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="img-thumbnail" width="80" height="80" style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('category.show', $category->category_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-info" title="Xem" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('category.edit', $category->category_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-warning" title="Chỉnh sửa" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('category.destroy', $category->category_id) }}?page={{ request()->get('page') }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
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
            @if ($categories->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Hiển thị từ <strong>{{ $categories->firstItem() }}</strong> đến
                        <strong>{{ $categories->lastItem() }}</strong>
                        trong tổng số <strong>{{ $categories->total() }}</strong> người dùng
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
