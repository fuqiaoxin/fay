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
            'phone' => 'required|regex:/^1[34578]\d{9}$/'
        ];
    }


    public function attributes()
    {
        return [
            'phone' => trans('web.phone'),
        ];
    }

}
