 <div class="col-lg-9">
     <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
         <div>
             <strong class="d-block py-2">Sản phẩm</strong>
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

     <!-- List products -->
     <div class="row">
         <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
             <div class="card h-100 product-card">
                 <div class="position-relative">
                     <a href="./detail.html">
                         <img src="#" class="card-img-top product-img" alt="iPhone 13 Pro Max" />
                     </a>
                 </div>
                 <div class="card-body">
                     <!-- name -->
                     <a class="text-dark text-decoration-none" href="./detail.html">
                         <h5 class="card-title product-title">
                             iPhone 13 Pro Max 128GB
                         </h5>
                     </a>
                     <!-- desc -->
                     <p class="card-text text-muted small">
                         Màn hình Super Retina XDR, Chip A15 Bionic
                     </p>
                     <!-- price -->
                     <div class="d-flex justify-content-between align-items-center">
                         <p class="card-text product-price mb-0">24.990.000₫</p>
                         <small class="text-decoration-line-through text-muted">29.990.000₫</small>
                     </div>
                 </div>
                 <!-- action -->
                 <div class="card-footer bg-transparent border-top-0 pt-0">
                     <a href="#!" class="btn btn-danger w-100 add-to-cart-btn">
                         <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                     </a>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pagination -->
     <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
         <ul class="pagination">
             <li class="page-item disabled">
                 <a class="page-link" href="#" aria-label="Previous">
                     <span aria-hidden="true">&laquo;</span>
                 </a>
             </li>
             <li class="page-item active">
                 <a class="page-link" href="#">1</a>
             </li>
             <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li>
             <li class="page-item d-none d-md-block">
                 <a class="page-link" href="#">4</a>
             </li>
             <li class="page-item d-none d-md-block">
                 <a class="page-link" href="#">5</a>
             </li>
             <li class="page-item">
                 <a class="page-link" href="#" aria-label="Next">
                     <span aria-hidden="true">&raquo;</span>
                 </a>
             </li>
         </ul>
     </nav>
 </div>
