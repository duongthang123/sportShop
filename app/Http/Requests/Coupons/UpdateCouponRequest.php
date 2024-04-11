<?php

namespace App\Http\Requests\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'name' => 'required|unique:coupons,name,'. $this->coupon,
            'value' => 'required|numeric|min:0|max:100',
            'expery_date' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Hãy nhập mã giảm giá',
            'name.unique' => 'Mã giảm giá đã tồn tại',
            'value.required' => 'Hãy nhập giá trị mã giảm giá',
            'value.min' => 'Giá trị mã phải lớn hơn bằng 0%',
            'value.max' => 'Giá trị mã phải nhỏ hơn 100%',
            'expery_date.required' => 'Hãy nhập ngày hết hạn',

        ];
    }
}
