@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('user.index') }}?page={{ request()->get('page') }}">
                                Người Dùng
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chỉnh Sửa #{{ $user->user_id }}
                        </li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Cập Nhật Người Dùng</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('user.update', $user->user_id) }}?page={{ request()->get('page') }}" method="POST"
                    class="card shadow">
                    @csrf
                    @method('PUT')

                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Người Dùng</h5>
                    </div>

                    <div class="card-body p-4">
                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Họ Tên <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                value="{{ old('name', $user->name) }}" required />
                            @if ($errors->has('name'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        {{-- Phone --}}
                        <div class="mb-4">
                            <label for="phone" class="form-label fw-bold">Số Điện Thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                value="{{ old('phone', $user->phone) }}" required />
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                value="{{ old('email', $user->email) }}" required />
                            @if ($errors->has('email'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Mật Khẩu</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Nhập mật khẩu mới nếu muốn đổi" />
                            @if ($errors->has('password'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold">Xác Nhận Mật Khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control form-control-lg" placeholder="Nhập lại mật khẩu" />
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('role_id') }}
                                </div>
                            @endif
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label for="role_id" class="form-label fw-bold">Vai Trò <span
                                    class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" class="form-select form-select-lg" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}"
                                        {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('role_id'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('role_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between">
                        <a href="{{ route('user.index') }}?page={{ request()->get('page') }}"
                            class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Quay Lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
