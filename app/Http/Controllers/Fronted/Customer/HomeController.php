<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Định nghĩa số lượng danh mục nổi bật hiển thị mỗi trang
    const FEATURED_CATEGORIES_LIMIT = 4;
    // Định nghĩa số lượng sản phẩm nổi bật hiển thị mỗi trang
    const FEATURED_PRODUCTS_LIMIT = 8;

    /**
     *  Hiển thị trang chủ cho khách hàng.
     */
    public function index()
    {
        // Lấy tất cả các slide từ cơ sở dữ liệu, sắp xếp theo thời gian tạo giảm dần
        $slides = Slide::orderBy('created_at', 'desc')->get();

        // Lấy 4 danh mục nổi bật (is_featured = true)
        $featuredCategories = Category::where('is_featured', true)->take(self::FEATURED_CATEGORIES_LIMIT)->get();

        // Lấy 8 sản phẩm nổi bật (is_featured = true)
        $featuredProducts = Product::where('is_featured', true)->take(self::FEATURED_PRODUCTS_LIMIT)->get();

        // Trả về view trang chủ, với dữ liệu slide, danh mục nổi bật và sản phẩm nổi bật
        return view('frontend.pages.index', compact('slides', 'featuredCategories', 'featuredProducts'));
    }
}
