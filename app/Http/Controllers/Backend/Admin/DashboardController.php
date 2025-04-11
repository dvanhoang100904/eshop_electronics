<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userCount = User::Count();
        return view('backend.dashboard.dashboard', compact('userCount'));
    }
}
