@extends('backend.admin')

@section('content')
    <h2>Chào mừng bạn đến với Trang Quản Trị</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <i class="fas fa-box fa-2x"></i>
                    <h5 class="mt-2">20 Sản Phẩm</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <i class="fas fa-list fa-2x"></i>
                    <h5 class="mt-2">5 Danh Mục</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <i class="fas fa-users fa-2x"></i>
                    <h5 class="mt-2">15 Người Dùng</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                    <h5 class="mt-2">12 Đơn Hàng</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
