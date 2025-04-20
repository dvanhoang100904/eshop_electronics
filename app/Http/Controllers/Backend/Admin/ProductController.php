<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Định nghĩa số lượng sản phẩm hiển thị mỗi trang (dùng cho phân trang)
    const PER_PAGES = 10;

    /**
     * Hiển thị danh sách sản phẩm với các bộ lọc và tìm kiếm.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Lấy tất cả danh mục để hiển thị trong bộ lọc
        $categories = Category::all();

        // Kiểm tra và thực hiện tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc sản phẩm theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc sản phẩm theo sản phẩm nổi bật
        if ($request->has('is_featured')) {
            $query->where('is_featured', (int) $request->is_featured);
        }

        // Phân trang kết quả
        $products = $query->paginate(self::PER_PAGES)->appends($request->only('search', 'category_id', 'is_featured'));

        // Trả về view với danh sách sản phẩm và danh mục
        return view('backend.product.index', compact('products', 'categories'));
    }

    /**
     * Hiển thị form tạo mới sản phẩm.
     */
    public function create()
    {
        // Lấy tất cả danh mục để người dùng chọn khi tạo sản phẩm mới
        $categories = Category::all();
        return view('backend.product.create', compact('categories'));
    }

    /**
     * Lưu sản phẩm mới vào cơ sở dữ liệu.
     */
    public function store(ProductRequest $request)
    {
        // Nếu có file ảnh, lưu trữ ảnh sản phẩm
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        // Tạo slug từ tên sản phẩm nếu không có slug sẵn
        $slug = $request->slug ?: Str::slug($request->name, '-');

        // Lưu thông tin sản phẩm mới
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' =>   $imageName,
            'category_id' => $request->category_id,
            'is_featured' => $request->is_featured,
            'slug' => $slug

        ]);

        // Trả về trang danh sách sản phẩm sau khi thêm thành công
        $page = $request->get('page');
        return redirect()->route('product.index', ['page' => $page])->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Hiển thị chi tiết sản phẩm.
     */
    public function show($product_id)
    {
        // Tìm sản phẩm theo product_id và trả về view chi tiết
        $product = Product::findOrFail($product_id);
        return view('backend.product.show', compact('product'));
    }

    /**
     * Hiển thị form chỉnh sửa sản phẩm.
     */
    public function edit($product_id)
    {
        // Lấy thông tin sản phẩm cần chỉnh sửa và danh mục để chọn
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    /**
     * Cập nhật thông tin sản phẩm.
     */
    public function update(ProductRequest $request, $product_id)
    {
        // Tìm sản phẩm cần cập nhật
        $product = Product::findOrFail($product_id);

        // Tạo slug từ tên sản phẩm nếu không có slug sẵn
        $slug = $request->slug ?: Str::slug($request->name, '-');

        // Chuẩn bị dữ liệu để cập nhật
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_featured' => $request->is_featured,
            'slug' => $request->$slug
        ];

        // Nếu có ảnh mới, lưu ảnh và xóa ảnh cũ nếu có
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');

            // Xóa ảnh cũ nếu có
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $imageName;
        }

        // Cập nhật sản phẩm
        $product->update($data);

        // Trả về trang danh sách sản phẩm sau khi cập nhật
        $page = $request->get('page');
        return redirect()->route('product.index', ['page' => $page])->with('success', 'Cập nhật sản phẩm thành công');
    }


    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     */
    public function destroy($product_id, Request $request)
    {
        // Tìm sản phẩm cần xóa
        $product = Product::findOrFail($product_id);

        // Xóa ảnh nếu có
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Xóa sản phẩm
        $product->delete();

        // Trả về trang danh sách sản phẩm sau khi xóa
        $page = $request->get('page');
        return redirect()->route('product.index', ['page' => $page])->with('success', 'Xóa sản phẩm thành công');
    }
}
