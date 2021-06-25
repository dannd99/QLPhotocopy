<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Password extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'password' => 'required|same:password|min:8',
            'password_confirmation' => 'required|same:password',    
        ];
    }
    public function messages()
    {
        return [
            'password.required'                     => __('Bạn chưa nhập Mật khẩu mới'),
            'password.same'                         => __('Mật khẩu nhập lại không đúng'),
            'password.min'                          => __('Mật khẩu phải hơn 8 ký tự.'),
            'password_confirmation.required'        => __('Mật khẩu nhập lại không đúng'),
            'password_confirmation.same'            => __('Mật khẩu nhập lại không đúng'),
        ];
    }
}
