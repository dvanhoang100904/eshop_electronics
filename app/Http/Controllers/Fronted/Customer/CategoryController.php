<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Định nghĩa số lượng sản phẩm hiển thị mỗi trang
    const PER_PAGES = 8;

    /**
     * Hiển thị sản phẩm theo danh mục.
     */
    public function showProductsByCategory($slug)
    {
        // Tìm danh mục theo slug (nếu không tìm thấy thì trả về lỗi 404)
        $category = Category::where('slug', $slug)
            ->firstOrFail();

        // Lấy các sản phẩm thuộc danh mục này và phân trang (8 sản phẩm mỗi trang)
        $products = $category->products()
            ->paginate(self::PER_PAGES);

        // Trả về view với các dữ liệu danh mục và sản phẩm
        return view('frontend.pages.category-products', compact('category', 'products'));
    }
}
