<header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
    <div>
        <strong class="d-block py-2">Tổng {{ $products->total() }} Sản phẩm</strong>
    </div>

    <div class="ms-auto d-flex">
        <form action="{{ route('customer.product') }}" method="GET" class="w-100">
            <select class="form-select me-2" name="sort" style="width: 180px" onchange="this.form.submit()">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao
                </option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao đến thấp
                </option>
                <option value="best_selling" {{ request('sort') == 'best_selling' ? 'selected' : '' }}>Bán chạy nhất
                </option>
            </select>
        </form>
        <div class="btn-group shadow-sm">
            <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="btn btn-light" title="Danh sách">
                <i class="fa fa-bars"></i>
            </a>
            <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" class="btn btn-danger active"
                title="Lưới">
                <i class="fa fa-th"></i>
            </a>
        </div>
    </div>
</header>
