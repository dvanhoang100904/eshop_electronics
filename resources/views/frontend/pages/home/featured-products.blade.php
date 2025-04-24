<!-- Featured Products -->
<section class="my-5 py-4 bg-light">
    <div class="container">
        <header class="mb-4 text-center">
            <h3 class="section-title">Sản Phẩm Nổi Bật</h3>
            <p class="text-muted">Những sản phẩm bán chạy nhất của chúng tôi</p>
        </header>

        <div class="row">
            @foreach ($featuredProducts as $featuredProduct)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 product-card">
                        <div class="position-relative">
                            <!-- image -->
                            <a href="{{ route('customer.product.show', $featuredProduct->slug) }}">
                                <img src="{{ asset('storage/' . $featuredProduct->image) }}"
                                    class="card-img-top product-img" alt="{{ $featuredProduct->name }}" />
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- name -->
                            <a class="text-dark text-decoration-none"
                                href="{{ route('customer.product.show', $featuredProduct->slug) }}">
                                <h5 class="card-title product-title">
                                    {{ $featuredProduct->name }}
                                </h5>
                            </a>
                            <!-- desc -->
                            <p class="card-text text-muted small">
                                {{ Str::limit($featuredProduct->description, 80) }}
                            </p>
                            <!-- price -->
                            <p class="card-text product-price mb-0">
                                {{ number_format($featuredProduct->price, 0, ',', '.') }} VNĐ
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('customer.product') }}" class="btn btn-outline-danger px-4">
                <i class="fas fa-arrow-right me-2"></i>Xem tất cả
            </a>
        </div>
    </div>
</section>
