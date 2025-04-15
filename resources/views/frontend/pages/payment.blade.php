@extends('frontend.layouts.customer-layout')

@section('title', 'Trang thanh toán')

@section('content')
    <section class="bg-light py-5">
        <div class="container">
            <!-- form -->
            <form>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 mb-4">
                        <!-- Checkout -->
                        <div class="card shadow-0 border">
                            <div class="p-4">
                                <h5 class="card-title mb-4">Thông tin đơn hàng</h5>
                                <!-- List products -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Product 1 -->
                                        <div class="row align-items-center mb-5">
                                            <!-- image -->
                                            <div class="col-md-2">
                                                <img src="#" class="img-fluid rounded" alt="Áo khoác mùa đông" />
                                            </div>
                                            <!-- name -->
                                            <div class="col-md-4">
                                                <h6 class="mb-1">Áo khoác mùa đông</h6>
                                            </div>
                                            <!-- quantity -->
                                            <div class="col-md-3">
                                                Số lượng:
                                                <b class="text-muted small">1</b>
                                            </div>
                                            <!-- price -->
                                            <div class="col-md-2">
                                                <p class="mb-0 fw-bold">1.156.000 VND</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <h5 class="card-title mb-4">Thông tin thanh toán</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" type="text"
                                                placeholder="Tên người nhận" />
                                            <label for="name">Tên</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="phone" type="tel" placeholder="SĐT" />
                                            <label for="phone">SĐT</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" type="email" placeholder="Email" />
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="address" type="text"
                                                placeholder="Địa chỉ giao hàng" />
                                            <label for="address">Địa chỉ giao hàng</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-outline mb-3">
                                            <label for="paymentMethod" class="mb-2">Phương thức thanh toán</label>
                                            <select class="form-select" id="paymentMethod" required>
                                                <option value="cod">COD</option>
                                                <option value="paypal">Momo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="note" placeholder="Nhập ghi chú" style="height: 140px; resize: none"></textarea>
                                            <label for="note">Ghi chú</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                    <button type="submit" class="btn btn-success">
                                        Thanh toán
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tổng payment -->
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
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Phí vận chuyển:</p>
                                        <p class="mb-2">0 VND</p>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2 fw-bold">Tổng thanh toán:</p>
                                        <p class="mb-2 fw-bold">1.200.800 VND</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
