<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        // Tìm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo sản phẩm nổi bật
        if ($request->has('is_featured')) {
            $query->where('is_featured', (int) $request->is_featured);
        }

        $perPage = 10;
        $products = $query->paginate($perPage)->appends($request->only('search', 'category_id', 'is_featured'));
        return view('backend.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' =>   $imageName,
            'category_id' => $request->category_id,
            'is_featured' => $request->is_featured

        ]);

        $page = $request->get('page');

        return redirect()->route('product.index', ['page' => $page])->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_featured' => $request->is_featured
        ];

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $imageName;
        }

        $product->update($data);

        $page = $request->get('page');

        return redirect()->route('product.index', ['page' => $page])->with('success', 'Cập nhật sản phẩm thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id, Request $request)
    {
        $product = Product::findOrFail($product_id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        $page = $request->get('page');

        return redirect()->route('product.index', ['page' => $page])->with('success', 'Xóa sản phẩm thành công');
    }
}
