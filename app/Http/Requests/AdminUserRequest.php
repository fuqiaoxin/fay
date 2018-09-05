<?php

namespace App\Http\Requests;


class AdminUserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'string|required',
            'password' => 'string|required',
        ];
    }

    public function attributes()
    {
        return [
            'username' => '账号名称',
        ];
    }
}
