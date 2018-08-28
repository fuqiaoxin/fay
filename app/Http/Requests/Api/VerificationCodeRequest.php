<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class VerificationCodeRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => '手机号必须填写',
            'phone.regex'    => '手机格式错误',
            'phone.unique'   => '手机号已被注册',
        ];
    }


}
