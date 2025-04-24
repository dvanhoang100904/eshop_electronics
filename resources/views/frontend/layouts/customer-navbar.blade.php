<nav class="navbar navbar-expand-lg navbar-dark main-navbar">
    <div class="container">
        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ route('customer.index') }}">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./product.html">Sản Phẩm</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('/category') ? 'active' : '' }}" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh Mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item {{ request()->is('category/' . $category->slug) ? 'active' : '' }}"
                                    href="{{ route('customer.category.products', $category->slug) }}">
                                    <i class="fas fa-tag me-2 text-danger"></i>{{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</nav>
