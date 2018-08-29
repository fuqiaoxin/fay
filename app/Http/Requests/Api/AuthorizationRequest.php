<?php

namespace App\Http\Requests\Api;
use App\Http\Requests\Request;

class AuthorizationRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'verification_key'  => 'required',
            'verification_code' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'verification_key'  => trans('web.sms_code_key'),
            'verification_code' => trans('web.sms_code'),
        ];
    }
}
