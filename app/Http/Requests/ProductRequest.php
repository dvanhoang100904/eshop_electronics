<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product_id = $this->route('product_id');

        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'slug')->ignore($product_id, 'product_id')
            ],
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|integer',
            'is_featured' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'slug.string' => 'Slug phải là một chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 100 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn một slug khác.',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.numeric' => 'Giá phải là số',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'image.image' => 'File upload phải là hình ảnh',
            'image.max' => 'Dung lượng ảnh tối đa 2MB',
            'is_featured.boolean' => 'Trường "Nổi bật" phải là giá trị boolean (true hoặc false).',
        ];
    }
}
