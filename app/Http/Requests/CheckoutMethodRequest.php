<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutMethodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_method_id.exists' => 'Phương thức thanh toán không hợp lệ.',
            'shipping_method_id.required' => 'Vui lòng chọn phương thức vận chuyển.',
            'shipping_method_id.exists' => 'Phương thức vận chuyển không hợp lệ.',
        ];
    }
}