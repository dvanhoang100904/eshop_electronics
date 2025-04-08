   <!-- NAVBAR -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
       <div class="container-fluid">
           <a class="navbar-brand" href="#"><i class="fas fa-store"></i> Admin Dashboard</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
               <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
               <ul class="navbar-nav">
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                           <i class="fas fa-user"></i> Tài khoản
                       </a>
                       <ul class="dropdown-menu dropdown-menu-end">
                           <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                           <li>
                               <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">
                                   <i class="fas fa-sign-out-alt"></i> Đăng xuất
                               </a>
                           </li>
                       </ul>
                   </li>
               </ul>
           </div>
       </div>
   </nav>
