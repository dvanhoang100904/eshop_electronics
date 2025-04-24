<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->get();
        $featuredCategories = Category::where('is_featured', true)->take(4)->get();
        return view('frontend.pages.index', compact('slides', 'featuredCategories'));
    }
}
