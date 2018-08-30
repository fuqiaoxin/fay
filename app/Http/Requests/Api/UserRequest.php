<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use Auth;

class UserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = Auth::user()->id;
        return [
            'name'      => 'string|min:2|max:200',
            'email'     => 'email',
            'password'  => 'string|min:6|max:30',
            'avatar_image_id' => 'exists:images,id,type,avatar,user_id,'.$userId,
        ];
    }
}
