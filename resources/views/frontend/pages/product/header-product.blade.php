  <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
      <div>
          <strong class="d-block py-2">Tổng {{ $products->total() }} Sản phẩm</strong>
      </div>

      <div class="ms-auto d-flex">
          <select class="form-select me-2" style="width: 180px">
              <option>Sắp xếp theo</option>
              <option>Mới nhất</option>
              <option>Giá thấp đến cao</option>
              <option>Giá cao đến thấp</option>
              <option>Đánh giá cao nhất</option>
              <option>Bán chạy nhất</option>
          </select>
          <div class="btn-group shadow-sm">
              <a href="#" class="btn btn-light" title="Danh sách">
                  <i class="fa fa-bars"></i>
              </a>
              <a href="#" class="btn btn-danger active" title="Lưới">
                  <i class="fa fa-th"></i>
              </a>
          </div>
      </div>
  </header>
