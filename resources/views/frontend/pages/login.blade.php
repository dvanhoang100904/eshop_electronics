@extends('frontend.layouts.customer-layout')

@section('title', 'Đăng Nhập')

@section('content')
    <!-- main -->
    <main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Đăng Nhập</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" role="form" action="{{ route('customer.authLogin') }}">
                                @csrf

                                {{-- email --}}
                                <div class="form-floating mb-3">
                                    <input class="form-control mb-1" id="email" type="email" name="email"
                                        placeholder="Email" value="{{ old('email') }}" autofocus />
                                    <label for="email">Email </label>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>


                                {{-- password --}}
                                <div class="form-floating mb-3">
                                    <input class="form-control mb-1" id="password" type="password" name="password"
                                        placeholder="Password" />
                                    <label for="password">Mật khẩu</label>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                    <a class="small text-dark text-decoration-none me-3" href="#!">Quên mật
                                        khẩu?</a>
                                    <button type="submit" class="btn btn-danger">Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small">Bạn chưa có tài khoản?
                                <a class="text-danger text-decoration-none" href="{{ route('customer.register') }}">Đăng ký
                                    ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
