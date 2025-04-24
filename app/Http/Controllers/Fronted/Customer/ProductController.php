<?php

namespace App\Http\Controllers\Fronted\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Định nghĩa số lượng sản phẩm hiển thị mỗi trang
    const PER_PAGES = 12;

    /**
     * Hiển thị danh sách sản phẩm với phân trang.
     */
    public function index()
    {
        // Lấy tất cả các danh mục để hiển thị
        $categories = Category::all();

        // Lấy danh sách sản phẩm mới nhất và phân trang theo hằng số PER_PAGES
        $products = Product::latest()->paginate(self::PER_PAGES);

        // Trả về view với các danh mục và sản phẩm
        return view('frontend.pages.products', compact('categories', 'products'));
    }

    /**
     * Hiển thị chi tiết sản phẩm.
     */
    public function show($slug)
    {
        // Tìm sản phẩm theo slug. Nếu không tìm thấy, trả về lỗi 404
        $product = Product::where('slug', $slug)
            ->firstOrFail();

        // Trả về view chi tiết sản phẩm
        return view('frontend.pages.product-show', compact('product'));
    }

    /**
     * Tìm kiếm sản phẩm theo từ khóa.
     */
    public function search(Request $request)
    {
        // Lấy tất cả các danh mục để hiển thị
        $categories = Category::all();

        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('keyword');

        // Tìm kiếm sản phẩm có tên hoặc mô tả chứa từ khóa và phân trang theo hằng số PER_PAGES
        $products = Product::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(self::PER_PAGES);

        // Trả về view với danh mục, sản phẩm tìm được và từ khóa tìm kiếm
        return view('frontend.pages.products', compact('categories', 'products', 'keyword'));
    }
}
