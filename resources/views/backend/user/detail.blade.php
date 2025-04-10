@extends('backend.layouts.admin')

@section('content')
    <h2 class="mb-4">Chi tiết người dùng #{{ $user->user_id }}</h2>

    <div class="card p-4 shadow-sm">
        <h5>Thông Tin Người Dùng</h5>

        <!-- user_id -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Mã:</label>
            <div class="col-sm-10">{{ $user->user_id }}</div>
        </div>

        <!-- username -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Họ tên:</label>
            <div class="col-sm-10">{{ $user->name }}</div>
        </div>

        <!-- phone -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Số điện thoại:</label>
            <div class="col-sm-10">{{ $user->phone }}</div>
        </div>

        <!-- email -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Email:</label>
            <div class="col-sm-10">{{ $user->email }}</div>
        </div>

        <!-- role_id -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Vai trò:</label>
            <div class="col-sm-10">
                @if ($user->role)
                    {{ $user->role->name }} <!-- Giả sử `role` là mối quan hệ với bảng roles -->
                @else
                    Chưa có vai trò
                @endif
            </div>
        </div>

        <!-- created_at -->
        <div class="row mb-3">
            <label class="col-sm-2 fw-bold">Ngày tạo:</label>
            <div class="col-sm-10">{{ $user->created_at->format('Y-m-d') }}</div>
        </div>
    </div>

    <!-- action -->
    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('user.list') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>

        <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Chỉnh sửa
        </a>
    </div>
@endsection
