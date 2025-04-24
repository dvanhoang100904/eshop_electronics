@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-1 ms-3 py-3">
        <h2>Tạo Người Dùng Mới</h2>
    </div>

    <form action="{{ route('user.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <!-- username -->
        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
            <input type="text" name="name" id="username" class="form-control" required placeholder="Nhập họ tên"
                value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <!-- phone -->
        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" required
                placeholder="Nhập số điện thoại" pattern="[0-9]{10,12}" value="{{ old('phone') }}" />
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <!-- email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required
                value="{{ old('email') }}" />
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu"
                required />
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- password_confirmation -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">Xác nhận mật khẩu <span
                    class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Nhập lại mật khẩu" required />
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <!-- role_id -->
        <div class="mb-3">
            <label for="role_id" class="form-label fw-bold">Vai trò</label>
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Quản trị viên</option>
                <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Khách hàng</option>
            </select>
            @if ($errors->has('role_id'))
                <span class="text-danger">{{ $errors->first('role_id') }}</span>
            @endif
        </div>

        <!-- action -->
        <div class="mt-4 d-flex gap-3">
            <a href="{{ route('user.list') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu
            </button>
        </div>
    </form>
@endsection
