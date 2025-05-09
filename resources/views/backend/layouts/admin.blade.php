<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Trang Quản Trị')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('logo/logo.ico') }}" type="image/x-icon">

    <!-- Nhúng style bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Nhúng font cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet" />

    {{-- sweetalert2 css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.css"
        integrity="sha512-WnmDqbbAeHb7Put2nIAp7KNlnMup0FXVviOctducz1omuXB/hHK3s2vd3QLffK/CvvFUKrpioxdo+/Jo3k/xIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- My style --}}
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">

</head>

<body>

    {{-- Navbar --}}
    @include('backend.layouts.admin-navbar')

    <div class="d-flex">
        {{-- Sidebar --}}
        @include('backend.layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-grow-1 p-4 bg-light">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="footer-gradient text-white text-center py-3">
        Copyright © 2025 Admin Dashboard.
    </footer>

    @stack('scripts')

    <!-- Nhúng js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- sweetalert2 js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js"
        integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
