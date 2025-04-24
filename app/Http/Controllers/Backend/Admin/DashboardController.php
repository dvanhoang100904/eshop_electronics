<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::Count();
        $totalProducts = Product::Count();
        return view('backend.dashboard.dashboard', compact('totalUsers', 'totalProducts'));
    }
}
