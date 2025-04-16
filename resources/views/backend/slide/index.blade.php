@php
    use Illuminate\Support\Str;
@endphp

@extends('backend.layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0 fw-bold">
                    <i class="fas  fa-images me-2"></i>Danh Sách Slides
                </h2>
                <a href="{{ route('slide.create') }}?page={{ request()->get('page') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Thêm
                </a>
            </div>

            {{-- Slides Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="80" class="text-center">Mã</th>
                            <th width="180">Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th>Link</th>
                            <th width="180" class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($slides->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    Chưa có slide nào được thêm.
                                </td>
                            </tr>
                        @else
                            @foreach ($slides as $slide)
                                <tr>
                                    <td class="text-center fw-bold">#{{ $slide->slide_id }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}"
                                            class="img-thumbnail" width="160" height="160" style="object-fit: cover;">
                                    </td>
                                    <td>
                                        <i class="fas fa-images text-primary me-1"></i>
                                        {{ $slide->title }}
                                    </td>
                                    <td>
                                        {{ Str::limit($slide->description, 20) }}
                                    </td>
                                    <td>{{ $slide->link }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('slide.edit', $slide->slide_id) }}?page={{ request()->get('page') }}"
                                                class="btn btn-sm btn-warning" title="Chỉnh sửa" data-bs-toggle="tooltip">
                                                <i class="fas fa-edit "></i>
                                            </a>
                                            <form
                                                action="{{ route('slide.destroy', $slide->slide_id) }}?page={{ request()->get('page') }}"
                                                method="POST" style="display:inline;"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa slide không?');">
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
                        @endif

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($slides->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Hiển thị từ <strong>{{ $slides->firstItem() }}</strong> đến
                        <strong>{{ $slides->lastItem() }}</strong>
                        trong tổng số <strong>{{ $slides->total() }}</strong> người dùng
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item {{ $slides->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $slides->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            @foreach ($slides->getUrlRange(1, $slides->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $slides->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <li class="page-item {{ $slides->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $slides->nextPageUrl() }}" aria-label="Next">
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
