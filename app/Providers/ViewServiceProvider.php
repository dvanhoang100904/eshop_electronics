<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gửi danh mục đến mọi view chứa navbar
        View::composer('frontend.layouts.customer-navbar', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }
}
