<!-- Header -->
<header>
    <!-- Top Header -->
    <div class="p-3 text-center top-header">
        <div class="container">
            <div class="row gy-3 align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-sm-4 col-4">
                    <a href="{{ route('customer.index') }}" class="float-start">
                        <img src="{{ asset('logo/logo.png') }}" height="40" alt="Logo" />
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="col-lg-7 col-md-8 col-12">
                    <form action="{{ route('customer.product.search') }}" method="GET" class="input-group">
                        <input type="search" name="keyword" class="form-control rounded-start"
                            placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}" aria-label="Search" />
                        <button type="submit" class="btn search-btn text-white rounded-end">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Account and Cart -->
                <div class="col-lg-3 col-sm-8 col-8">
                    <div class="d-flex float-end">
                        <!-- Cart Button -->
                        <a href="{{ route('customer.cart') }}" class="btn btn-light me-2 cart-btn position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <!-- Optionally, you can display the number of items in the cart -->
                            @if (Auth::check() && Auth::user()->cart)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->cart->cartItems->count() }}
                                </span>
                            @endif
                        </a>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="btn btn-light dropdown-toggle user-btn" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                @auth
                                    @if (Auth::user()->role_id === 2)
                                        <!-- Logged in User (Customer) -->
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('customer.orders') }}">
                                                <i class="fas fa-history me-2"> </i> Lịch sử đơn hàng
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <form action="{{ route('customer.logout') }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                                                </button>
                                            </form>
                                        </li>
                                    @else
                                        <!-- Logged in Admin -->
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                <i class="fas fa-cogs me-2"></i>Quản trị
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('customer.logout') }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @else
                                    <!-- Not logged in -->
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.login') }}">
                                            <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.register') }}">
                                            <i class="fas fa-user-plus me-2"></i>Đăng Ký
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
