<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 5;
        $slides = Slide::paginate($perPage);
        return view('backend.slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
        }

        Slide::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'image' => $imagePath,
        ]);
        $page = $request->get('page');
        return redirect()->route('slide.index', ['page' => $page])->with('success', 'Slide đã được tạo thành công!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slide_id)
    {
        $slide = Slide::findOrFail($slide_id);
        return view('backend.slide.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request, $slide_id)
    {
        $slide = Slide::findOrFail($slide_id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link
        ];

        // Kiểm tra xem người dùng có chọn ảnh mới không
        if ($request->hasFile('image')) {
            // Lưu ảnh mới vào thư mục 'slides' trong storage
            $imageName = $request->file('image')->store('Slides', 'public');
            // Kiểm tra và xóa ảnh cũ nếu có
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }

            // Cập nhật trường tên ảnh mới

            $data['image'] = $imageName;
        }

        // Cập nhật slide với dữ liệu mới
        $slide->update($data);

        $page = $request->get('page');

        return redirect()->route('slide.index', ['page' => $page])->with('success', 'Cập nhật slide thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slide_id, Request $request)
    {
        $slide = slide::findOrFail($slide_id);

        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        $page = $request->get('page');

        return redirect()->route('slide.index', ['page' => $page])->with('success', 'Xóa slide thành công');
    }
}
