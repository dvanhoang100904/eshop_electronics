<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    // Định nghĩa số lượng slide hiển thị mỗi trang (dùng cho phân trang)
    const PER_PAGES = 5;

    /**
     * Hiển thị danh sách các slide (có phân trang).
     */
    public function index()
    {
        $slides = Slide::paginate(self::PER_PAGES);
        return view('backend.slide.index', compact('slides'));
    }
    /**
     * Hiển thị form thêm slide mới.
     */
    public function create()
    {
        return view('backend.slide.create');
    }

    /**
     * Lưu slide mới vào cơ sở dữ liệu.
     */
    public function store(SlideRequest $request)
    {
        // Kiểm tra nếu người dùng có tải lên ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Lưu ảnh vào thư mục 'slides' trong storage/public
            $imagePath = $request->file('image')->store('slides', 'public');
        }

        // Tạo slide mới
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
     * Hiển thị form chỉnh sửa slide.
     */
    public function edit($slide_id)
    {
        $slide = Slide::findOrFail($slide_id);
        return view('backend.slide.edit', compact('slide'));
    }


    /**
     * Cập nhật thông tin slide.
     */
    public function update(SlideRequest $request, $slide_id)
    {
        $slide = Slide::findOrFail($slide_id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link
        ];

        // Nếu có ảnh mới được tải lên
        if ($request->hasFile('image')) {
            // Lưu ảnh mới
            $imageName = $request->file('image')->store('Slides', 'public');

            // Xóa ảnh cũ nếu tồn tại
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }

            // Cập nhật trường tên ảnh mới
            $data['image'] = $imageName;
        }

        // Cập nhật dữ liệu
        $slide->update($data);

        $page = $request->get('page');

        return redirect()->route('slide.index', ['page' => $page])->with('success', 'Cập nhật slide thành công');
    }

    /**
     * Xóa slide khỏi hệ thống.
     */
    public function destroy($slide_id, Request $request)
    {
        $slide = slide::findOrFail($slide_id);

        // Nếu slide có ảnh thì xóa ảnh khỏi storage
        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        // Xóa slide khỏi database
        $slide->delete();

        $page = $request->get('page');

        return redirect()->route('slide.index', ['page' => $page])->with('success', 'Xóa slide thành công');
    }
}
