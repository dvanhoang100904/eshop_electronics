@extends('backend.layouts.admin')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-0 fw-bold">
                    <i class="fas fa-users me-2"></i>Danh Sách Đơn Hàng
                </h2>
                <a href="{{ route('user.create') }}?page={{ request()->get('page') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Thêm
                </a>
            </div>

            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('user.index') }}?page={{ request()->get('page') }}" method="GET" class="w-100">
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

            {{-- Users Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="80" class="text-center">Mã</th>
                            <th>Họ Tên</th>
                            <th>Số Điện Thoại</th>
                            <th>Email</th>
                            <th width="120" class="text-center">Vai Trò</th>
                            <th width="180" class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center fw-bold">#{{ $user->user_id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->role->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('user.show', $user->user_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-info" title="Xem" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $user->user_id) }}?page={{ request()->get('page') }}"
                                            class="btn btn-sm btn-warning" title="Chỉnh sửa" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('user.destroy', $user->user_id) }}?page={{ request()->get('page') }}"
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
            @include('backend.layouts.paginate', ['pagination' => $users])
        </div>
    </div>
@endsection
