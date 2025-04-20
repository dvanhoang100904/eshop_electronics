<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Định nghĩa số lượng danh mục hiển thị mỗi trang (dùng cho phân trang)
    const PER_PAGES = 5;

    /**
     * Hiển thị danh sách danh mục, hỗ trợ tìm kiếm và lọc theo nổi bật.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm theo tên danh mục
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục nổi bật
        if ($request->has('is_featured')) {
            $query->where('is_featured', (int) $request->is_featured);
        }

        // Phân trang kết quả và giữ lại các query string
        $categories  = $query->paginate(self::PER_PAGES)->appends($request->only('search', 'is_featured'));
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục mới.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu.
     */
    public function store(CategoryRequest $request)
    {
        $imageName = null;

        // Nếu có ảnh, lưu trữ ảnh danh mục
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('categories', 'public');
        }

        // Tạo slug từ tên danh mục nếu chưa có
        //$isFeatured = $request->input('is_featured', 0);
        $slug = $request->slug ?: Str::slug($request->name, '-');

        // Tạo danh mục mới
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'image' => $imageName,
            'is_featured' => $request->is_featured
        ]);

        // Quay lại danh sách danh mục
        $page = $request->get('page');
        return redirect()->route('category.index', ['page' => $page])->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Hiển thị chi tiết một danh mục.
     */
    public function show($category_id)
    {
        // Tìm danh mục theo category_id
        $category = Category::findOrFail($category_id);
        return view('backend.category.show', compact('category'));
    }

    /**
     * Hiển thị form chỉnh sửa danh mục.
     */
    public function edit($category_id)
    {
        // Tìm danh mục theo ID
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin danh mục.
     */
    public function update(CategoryRequest $request, $category_id)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($category_id);

        // Tạo slug nếu chưa có
        $slug = $request->slug ?: Str::slug($request->name, '-');

        // Chuẩn bị dữ liệu cập nhật
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'is_featured' =>  $request->is_featured
        ];

        // Nếu có ảnh mới, lưu và xóa ảnh cũ
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('categories', 'public');

            // Xóa ảnh cũ nếu tồn tại
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $imageName;
        }

        // Cập nhật danh mục
        $category->update($data);

        // Quay lại danh sách danh mục
        $page = $request->get('page');
        return redirect()->route('category.index', ['page' => $page])->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Xóa danh mục khỏi cơ sở dữ liệu.
     */
    public function destroy($category_id, Request $request)
    {
        // Tìm danh mục theo category_id
        $category = Category::findOrFail($category_id);

        // Xóa ảnh nếu có
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Xóa danh mục
        $category->delete();

        // Quay lại danh sách danh mục
        $page = $request->get('page');
        return redirect()->route('category.index', ['page' => $page])->with('success', 'Xóa danh mục thành công');
    }
}
