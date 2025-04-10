<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|digits_between:10,12',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|in:1,2',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ tên là bắt buộc.',
            'name.string' => 'Họ tên phải là một chuỗi ký tự.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu ít nhất phải có 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'role_id.required' => 'Vai trò là bắt buộc.',
            'role_id.in' => 'Vai trò không hợp lệ.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 12 chữ số.',
        ];
    }
}
