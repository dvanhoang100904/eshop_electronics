<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Định nghĩa số lượng người dùng hiển thị mỗi trang (dùng cho phân trang)
    const PER_PAGES = 10;

    /**
     * Hiển thị danh sách người dùng (có tìm kiếm và phân trang).
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Nếu có nhập từ khóa tìm kiếm, lọc theo tên hoặc email
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Phân trang và giữ nguyên tham số tìm kiếm khi chuyển trang
        $users = $query->paginate(self::PER_PAGES)->appends($request->only('search'));

        return view('backend.user.index', compact('users'));
    }

    /**
     * Hiển thị form tạo người dùng mới.
     */
    public function create()
    {
        // Lấy tất cả các vai trò để hiển thị trong form
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }

    /**
     * Lưu người dùng mới vào cơ sở dữ liệu.
     */
    public function store(StoreUserRequest $request)
    {
        // Tạo mới người dùng với thông tin từ form
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // giữ lại trang hiện tại khi redirect
        $page = $request->get('page');

        return redirect()->route('user.index', ['page' => $page])->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Hiển thị chi tiết người dùng.
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('backend.user.show', compact('user'));
    }

    /**
     * Hiển thị form chỉnh sửa thông tin người dùng.
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();
        return view('backend.user.edit', compact('user', 'roles'));
    }

    /**
     * Cập nhật thông tin người dùng.
     */
    public function update(UpdateUserRequest $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        // Cập nhật thông tin, nếu có nhập mật khẩu mới thì mã hóa lại
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $page = $request->get('page');

        return redirect()->route('user.index', ['page' => $page])->with('success', 'Thông tin người dùng đã được cập nhật.');
    }

    /**
     * Xóa người dùng khỏi hệ thống.
     */
    public function destroy($user_id, Request $request)
    {
        $user = User::findOrFail($user_id);

        // Không cho phép xóa chính mình (bảo vệ user đang đăng nhập)
        if (auth()->id() === $user->user_id) {
            return redirect()->route('user.index')->withErrors('Không thể xóa chính bạn.');
        }

        $user->delete();

        $page = $request->get('page');

        return redirect()->route('user.index', ['page' => $page])->with('success', 'Người dùng đã bị xóa.');
    }
}
