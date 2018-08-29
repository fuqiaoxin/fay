<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class UserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'string|min:2|max:200',
            'email'     => 'email',
            'password'  => 'string|min:6|max:30',
        ];
    }
}
