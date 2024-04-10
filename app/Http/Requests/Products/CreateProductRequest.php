<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required',
            'sale' => 'required',
            'active' => 'required',
            'size' => 'required',
            'category_ids' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Hãy nhập tên sản phẩm',
            'image.required' => 'Hãy chọn ảnh',
            'image.image' => 'Ảnh không đúng định dạng cho phép',
            'price.required' => 'Hãy nhập giá sản phẩm',
            'sale.required' => 'Hãy nhập giá giảm giá',
            'size.required' => 'Bạn cần thêm size cho sản phẩm',
            'category_ids.required' => 'Bạn cần chọn danh mục cho sản phẩm',

        ];
    }
}
