@extends('frontend.layouts.customer-layout')

@section('title', 'Đăng Ký')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Tạo tài khoản</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" role="form" action="{{ route('customer.authRegister') }}">
                            @csrf

                            {{-- name --}}
                            <div class="form-floating mb-3">
                                <input class="form-control mb-1" id="Name" type="text" placeholder="Name"
                                    name="name" value="{{ old('name') }}" autofocus />
                                <label for="Name">Tên</label>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            {{-- email --}}
                            <div class="form-floating mb-3">
                                <input class="form-control mb-1" id="email" type="email" name="email"
                                    placeholder="Email" value="{{ old('email') }}" autofocus />
                                <label for="email">Email </label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            {{-- phone --}}
                            <div class="form-floating mb-3">
                                <input class="form-control mb-1" id="phone" type="tel" name="phone"
                                    placeholder="Số điện thoại" value="{{ old('phone') }}" autofocus pattern="[0-9]{9,10}"
                                    title="Số điện thoại phải bắt đầu bằng 0 và có 10-11 chữ số" />
                                <label for="phone">Số điện thoại </label>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            {{-- password --}}
                            <div class="form-floating mb-3">
                                <input class="form-control mb-1" id="password" type="password" name="password"
                                    placeholder="Mật khẩu" />
                                <label for="password">Mật khẩu</label>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            {{-- confirm password --}}
                            <div class="form-floating mb-3">
                                <input class="form-control mb-1" id="passwordConfirm" type="password"
                                    name="password_confirmation" placeholder="Confirm password" />
                                <label for="passwordConfirm">Xác nhận mật khẩu</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                <a class="small text-dark text-decoration-none me-3" href="#!">Quên mật
                                    khẩu?</a>
                                <button type="submit" class="btn btn-danger">Tạo</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">Bạn đã có tài khoản?
                            <a class="text-danger text-decoration-none" href="{{ route('customer.login') }}">Đăng Nhập
                                ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
