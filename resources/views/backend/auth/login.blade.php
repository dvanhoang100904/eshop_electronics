<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Đăng Nhập Quản Trị')</title>
    <!-- Favicon -->
    <link rel="icon" href="./images/logo.png" type="image/png" />

    <!-- Nhúng style bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Nhúng font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />

    {{-- My style --}}
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}" />

</head>

<body>
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
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" role="form" action="{{ route('admin.authLogin') }}">
                                @csrf
                                {{-- email --}}
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Email" value="{{ old('email') }}" autofocus />
                                    <label for="email">Email </label>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                                {{-- password --}}
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Password" />
                                    <label for="password">Password</label>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger"> {{ $errors->first('password') }}</span>
                                @endif

                                <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                    <a href="#!" class="small text-light text-decoration-none me-3"
                                        href="#!">Quên mật
                                        khẩu?</a>
                                    <button type="submit" class="btn btn-danger">Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Nhúng js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
