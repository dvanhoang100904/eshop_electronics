@extends('frontend.layouts.customer-layout')

@section('title', 'Trang giỏ hàng')
@section('content')
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <!-- List products -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Giỏ Hàng Của Bạn</h4>

                            <!-- product 1 -->
                            <div class="row align-items-center mb-5">
                                <!-- image -->
                                <div class="col-md-2">
                                    <img src="#!" class="img-fluid rounded" alt="Áo khoác mùa đông" />
                                </div>
                                <!-- name -->
                                <div class="col-md-4">
                                    <h6 class="mb-1">Áo khoác mùa đông</h6>
                                </div>
                                <!-- quantity -->
                                <div class="col-md-3">
                                    <div class="input-group" style="width: 150px">
                                        <button class="btn btn-outline-danger" type="button">
                                            -
                                        </button>
                                        <input type="number" class="form-control text-center" value="1"
                                            min="1" />
                                        <button class="btn btn-outline-danger" type="button">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <!-- price -->
                                <div class="col-md-2">
                                    <p class="mb-0 fw-bold">1.156.000 VND</p>
                                </div>
                                <!-- action -->
                                <div class="col-md-1">
                                    <button class="btn btn-link text-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Tổng Kết Đơn Hàng</h5>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Tổng tiền:</p>
                                    <p class="mb-2">1.200.800 VND</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Giảm giá:</p>
                                    <p class="mb-2 text-success">0 VND</p>
                                </div>

                                <hr />
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2 fw-bold">Tổng thanh toán:</p>
                                    <p class="mb-2 fw-bold">1.200.800 VND</p>
                                </div>
                            </div>

                            <!-- action -->
                            <a href="./payment-cart.html" class="btn btn-danger w-100">
                                Đặt hàng
                            </a>
                            <a href="./index.html" class="btn btn-checkout w-100 mb-2">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
