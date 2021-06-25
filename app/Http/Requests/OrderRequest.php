<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'printed_start'         => 'required|integer|',
            'printed_end'           => 'required|integer|gte:printed_start',
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
            'printed_start.required'            => __('Bạn chưa nhập Trang đầu tiên.'),
            'printed_start.integer'             => __('Chỉ được nhập số.'),
            'printed_end.gt'                    => __('Số trang Kết thúc không hợp lệ.'),
            'printed_end.required'              => __('Bạn chưa nhập Trang cuối cùng.'),
            'printed_end.integer'               => __('Chỉ được nhập số.'),
            'printed_end.min'                   => __('Trang cuối cùng phải lớn hơn Trang đầu tiên.'),
        ];
    }
}
