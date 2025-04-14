   <div class="col-lg-3">
       <!-- Toggle button for mobile -->
       <button class="btn btn-danger mb-3 w-100 d-lg-none" type="button" data-bs-toggle="collapse"
           data-bs-target="#sidebarFilters" aria-expanded="false" aria-label="Toggle filters">
           <i class="fas fa-filter me-2"></i> Bộ lọc sản phẩm
       </button>

       <div class="collapse card d-lg-block mb-5" id="sidebarFilters">
           <div class="card-header bg-danger text-white">
               <h5 class="mb-0">
                   <i class="fas fa-sliders-h me-2"></i> Bộ lọc
               </h5>
           </div>

           <div class="accordion" id="accordionFilters">
               <!-- Categories -->
               <div class="accordion-item border-0">
                   <h2 class="accordion-header" id="headingOne">
                       <button class="accordion-button bg-light text-dark" type="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           <i class="fas fa-list me-2 text-danger"></i> Danh Mục
                       </button>
                   </h2>
                   <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                       data-bs-parent="#accordionFilters">
                       <div class="accordion-body p-0">
                           <ul class="list-unstyled mb-0">
                               @foreach ($categories as $category)
                                   <li class="mb-1">
                                       <a href="{{ route('customer.category.products', $category->slug) }}"
                                           class="d-block p-2 text-decoration-none text-dark hover-danger">
                                           <img src="{{ asset('storage/' . $category->image) }}"
                                               alt="{{ $category->name }}" class="me-2 rounded"
                                               style="width: 24px; height: 24px; object-fit: cover;">
                                           {{ $category->name }}
                                       </a>
                                   </li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
               </div>

               <div class="accordion-item border-0">
                   <h2 class="accordion-header">
                       <button class="accordion-button bg-light text-dark collapsed" type="button">
                           <i class="fas fa-tags me-2 text-danger"></i> Thương hiệu
                       </button>
                   </h2>
                   <div class="accordion-collapse collapse"></div>
               </div>

               <div class="accordion-item border-0">
                   <h2 class="accordion-header">
                       <button class="accordion-button bg-light text-dark collapsed" type="button">
                           <i class="fas fa-dollar-sign me-2 text-danger"></i> Khoảng
                           giá
                       </button>
                   </h2>
               </div>

               <div class="accordion-item border-0">
                   <h2 class="accordion-header">
                       <button class="accordion-button bg-light text-dark collapsed" type="button">
                           <i class="fas fa-star me-2 text-danger"></i> Đánh giá
                       </button>
                   </h2>
               </div>
           </div>
       </div>
   </div>
