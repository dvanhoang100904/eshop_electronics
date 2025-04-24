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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục nổi bật
        if ($request->has('is_featured')) {
            $query->where('is_featured', (int) $request->is_featured);
        }

        $perPage = 5;
        $categories  = $query->paginate($perPage)->appends($request->only('search', 'is_featured'));
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('categories', 'public');
        }

        $slug = $request->slug ?: Str::slug($request->name, '-');

        // $isFeatured = $request->input('is_featured', 0);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'image' => $imageName,
            'is_featured' => $request->is_featured
        ]);

        $page = $request->get('page');

        return redirect()->route('category.index', ['page' => $page])->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $slug = $request->slug ?: Str::slug($request->name, '-');

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'is_featured' =>  $request->is_featured

        ];

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('categories', 'public');

            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $imageName;
        }

        $category->update($data);

        $page = $request->get('page');

        return redirect()->route('category.index', ['page' => $page])->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id, Request $request)
    {
        $category = Category::findOrFail($category_id);

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        $page = $request->get('page');

        return redirect()->route('category.index', ['page' => $page])->with('success', 'Xóa danh mục thành công');
    }
}
