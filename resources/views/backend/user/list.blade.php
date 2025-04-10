@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Form tìm kiếm -->
        <form action="{{ route('user.list') }}" method="GET" class="w-25">
            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm người dùng..."
                value="{{ request()->search }}" />
        </form>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh Sách Người Dùng</h2>
        <a href="{{ route('user.create') }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Tạo
        </a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã</th>
                    <th>Họ Tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Vai Trò</th>
                    <th>Ngày Tạo</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="d-flex justify-content-center gap-3">
                            <a href="{{ route('user.show', $user->user_id) }}" class="btn btn-sm btn-info" title="Xem">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-sm btn-warning"
                                title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user->user_id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">

            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}">Trước</a>
            </li>

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() }}">Tiếp</a>
            </li>
        </ul>
    </nav>
@endsection
