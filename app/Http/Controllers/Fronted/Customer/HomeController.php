<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->get();
        return view('frontend.pages.index', compact('slides'));
    }
}
