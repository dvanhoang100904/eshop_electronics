@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-3 fw-bold">
                <i class="fas fa-user me-2"></i> Chi tiết Người Dùng
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none text-dark"
                            href="{{ route('user.index') }}?page={{ request()->get('page') }}">
                            Người Dùng
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chi Tiết #{{ $user->user_id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Thông tin người dùng -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i> Thông Tin Cơ Bản
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-muted" width="25%">Mã người dùng:</td>
                                    <td><span class="badge bg-light text-dark fs-6">#{{ $user->user_id }}</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Họ tên:</td>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Số điện thoại:</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Email:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Vai trò:</td>
                                    <td>
                                        @if ($user->role)
                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                {{ $user->role->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">Chưa có vai trò</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">Ngày tạo:</td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $user->created_at->format('d/m/Y H:i') }}
                                        <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                    </td>
                                </tr>

                                <!-- Cập nhật cuối -->
                                <tr>
                                    <td class="fw-bold text-muted">Cập nhật cuối:</td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $user->updated_at->format('d/m/Y H:i') }}
                                        <small class="text-muted">({{ $user->updated_at->diffForHumans() }})</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-image me-2"></i> Ảnh đại diện
                    </h5>
                </div>
                {{-- <div class="card-body text-center">
                    <div class="user-image-container mb-3">
                        <img src="{{ $user ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                            class="img-fluid rounded-circle border" alt="{{ $user->name }}"
                            style="max-height: 200px; object-fit: cover;">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Action button -->
    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('user.index') }}?page={{ request()->get('page') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>

        <a href="{{ route('user.edit', $user->user_id) }}?page={{ request()->get('page') }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Chỉnh sửa
        </a>
    </div>
@endsection
