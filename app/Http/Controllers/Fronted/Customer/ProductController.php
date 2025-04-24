<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->paginate(12);
        return view('frontend.pages.products', compact('categories', 'products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.product-show', compact('product'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'LIKE', "%{$keyword}%")->orWhere('description', 'LIKE', "%{$keyword}%")->latest()->paginate(12);

        return view('frontend.pages.products', compact('categories', 'products', 'keyword'));
    }
}
