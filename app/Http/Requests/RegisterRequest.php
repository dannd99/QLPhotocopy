<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                 =>'required|email',
            'password'              => 'required|same:password|min:8',
            'password_confirmation' => 'required|same:password',  
        ];
    }
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'email.required'                    => __('Bạn chưa nhập Email.'),
            'email.email'                       => __('Email không đúng định dạng'),
            'password.min'                      => __('Mật khẩu phải hơn 8 ký tự.'),
            'password.max'                      => __('Mật khẩu phải không được vượt quá 255 ký tự.'),
            'password.required'                 => __('Mật khẩu là trường bắt buộc'),
            'password_confirmation.required'    => __('Mật khẩu nhập lại không đúng'),
            'password_confirmation.same'        => __('Mật khẩu nhập lại không đúng'),
        ];
    }
}
