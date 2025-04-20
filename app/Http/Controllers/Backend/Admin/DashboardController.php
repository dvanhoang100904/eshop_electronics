<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard chính cho admin.
     */
    public function dashboard()
    {
        $totalUsers = User::Count();
        $totalProducts = Product::Count();
        $totalCategories = Category::Count();
        $totalOrders = Order::count();
        return view('backend.dashboard.dashboard', compact('totalUsers', 'totalProducts', 'totalCategories', 'totalOrders'));
    }
}
