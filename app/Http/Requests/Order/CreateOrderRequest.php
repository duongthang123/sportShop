<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'required',
            'payment' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Hãy nhập họ tên bạn',
            'customer_phone.required' => 'Hãy nhập số điện thoại của bạn',
            'customer_address.required' => 'Hãy nhập địa chỉ giao hàng',
            'customer_email.required' => 'Hãy nhập email của bạn',
            'payment.required' => 'Hãy chọn hình thức thanh toán',
        ];
    }
}
