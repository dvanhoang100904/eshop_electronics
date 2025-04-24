@extends('frontend.layouts.customer-layout')

@section('title', 'Trang Sản Phẩm')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            @include('frontend.pages.product.sidebar-filters')
            <!-- main content -->
            @include('frontend.pages.product.main-content')
        </div>
    </div>
@endsection
