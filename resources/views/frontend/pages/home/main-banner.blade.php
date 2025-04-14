<section class="mt-4">
    <div class="container">
        <div id="bannerCarousel" class="carousel slide banner-carousel" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($slides as $index => $slide)
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <!-- Slides -->
            <div class="carousel-inner rounded-3">
                @foreach ($slides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100"
                            alt="{{ $slide->title }}" style="height: 400px; object-fit: cover" />
                        <div class="carousel-caption d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <h2 class="text-white fw-bold mb-3">
                                    {{ $slide->title }}
                                </h2>
                                @if ($slide->description)
                                    <p class="text-white d-none d-md-block mb-4">
                                        {{ $slide->description }}
                                    </p>
                                @endif
                                @if ($slide->link)
                                    <a href="{{ $slide->link }}"
                                        class="btn btn-light shadow-0 text-danger fw-bold px-4">Xem thêm</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
