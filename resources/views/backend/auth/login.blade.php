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

<body class="bg-light">
    <main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header bg-danger text-white text-center">
                            <img src="./images/logo.png" alt="Logo" class="mb-3" style="height: 50px;">
                            <h3>Đăng Nhập Hệ Thống</h3>
                        </div>
                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" role="form" action="{{ route('admin.authLogin') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input class="form-control" id="email" type="email" name="email"
                                            placeholder="Nhập email" value="{{ old('email') }}" autofocus />
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input class="form-control" id="password" type="password" name="password"
                                            placeholder="Nhập mật khẩu" />
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                    </div>
                                    <a href="#!" class="text-decoration-none">Quên mật khẩu?</a>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <small class="text-muted">© 2025 Login Admin.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- my js --}}
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Nhúng js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
