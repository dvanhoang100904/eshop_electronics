<!-- Featured Categories -->
<section class="mt-5 py-4">
    <div class="container">
        <h3 class="section-title mb-5 text-center">Danh mục nổi bật</h3>
        <div class="row g-4">
            @foreach ($featuredCategories as $featuredCategory)
                <div class="col-6 col-md-3">
                    <a href="{{ route('customer.category.products', $featuredCategory->slug) }}"
                        class="card featured-category text-decoration-none text-center h-100">
                        <div class="card-body py-4">
                            <div class="category-icon mb-5">
                                <img src="{{ asset('storage/' . $featuredCategory->image) }}"
                                    alt="{{ $featuredCategory->name }}" class="img-fluid category-image">
                            </div>
                            <h5 class="card-title">{{ $featuredCategory->name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
