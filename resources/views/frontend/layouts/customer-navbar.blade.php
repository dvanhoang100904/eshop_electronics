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
                    <a class="nav-link active" href="{{ route('customer.index') }}">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./product.html">Sản Phẩm</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Danh Mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="/danh-muc/dien-thoai">
                                <i class="fas fa-mobile-alt me-2"></i>Điện thoại, Tablet
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/danh-muc/lap-top">
                                <i class="fas fa-laptop me-2"></i>Laptop
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/danh-muc/am-thanh">
                                <i class="fas fa-headphones me-2"></i>Âm thanh
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/danh-muc/phu-kien">
                                <i class="fas fa-keyboard me-2"></i>Phụ kiện
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
