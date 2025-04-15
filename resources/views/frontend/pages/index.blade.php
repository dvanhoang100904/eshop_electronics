@extends('frontend.layouts.customer-layout')

@section('title', 'Trang Chủ')

@section('content')
    <section class="mt-5 py-4">
        <!-- Main Banner -->
        @include('frontend.pages.home.main-banner')

        <!-- Featured Categories -->
        @include('frontend.pages.home.featured-categories')

        <!-- Featured Products -->
        @include('frontend.pages.home.featured-products')
    </section>
@endsection
