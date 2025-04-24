@extends('backend.layouts.admin')

@section('content')
    <div class="dashboard-header">
        <h1 class="text-dark mb-4">Dashboard</h1>
        <p class="text-muted">Tổng quan hệ thống và thống kê nhanh</p>
    </div>

    <div class="row mb-4">
        <!-- Thống kê tổng quan -->
        <div class="col-md-3 mb-4">
            <div class="card stat-card bg-primary-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">SẢN PHẨM</h6>
                            <h3 class="stat-value">{{ $totalProducts }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card stat-card bg-warning-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">DANH MỤC</h6>
                            <h3 class="stat-value">{{ $totalCategories }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-list"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card stat-card bg-success-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">NGƯỜI DÙNG</h6>
                            <h3 class="stat-value">{{ $totalUsers }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card stat-card bg-danger-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title">ĐƠN HÀNG</h6>
                            <h3 class="stat-value">{{ $totalOrders }}</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
