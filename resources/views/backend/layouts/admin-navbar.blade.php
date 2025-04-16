<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-gradient sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-store"></i> Admin Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Tài khoản Admin -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-shield"></i> Quản trị
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth
                            @if (Auth::user()->role_id === 1)
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('customer.index') }}" target="_blank">
                                        <i class="fas fa-globe me-2"></i>Xem trang khách hàng
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                                        </button>
                                    </form>
                                </li>
                            @endif
                        @else
                            <!-- Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập admin -->
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.login') }}">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập (Admin)
                                </a>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
