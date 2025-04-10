<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);

        return view('backend.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('user.list')->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('backend.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('backend.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('user.list')->with('success', 'Thông tin người dùng đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        if (auth()->id() === $user->user_id) {
            return redirect()->route('user.list')->withErrors('Không thể xóa chính bạn.');
        }

        $user->delete();

        return redirect()->route('user.list')->with('success', 'Người dùng đã bị xóa.');
    }
}
