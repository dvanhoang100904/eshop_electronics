@extends('frontend.layouts.customer')

@section('title', 'Trang Chủ')

@section('content')
    <!-- Main Banner -->
    @include('frontend.pages.home.main-banner')

    <!-- Featured Categories -->
    @include('frontend.pages.home.featured-categories')

    <!-- Featured Products -->
    @include('frontend.pages.home.featured-products')
@endsection
