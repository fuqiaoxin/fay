<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class ImageRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type' => 'required|string|in:avatar,topic',
        ];
        if($this->type == 'avatar'){
            $rules['image'] = 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';
        }else{
            $rules['image'] = 'mimes:jpeg,bmp,png,gif';
        }
        return $rules;
    }


    public function messages()
    {
        return [
            'image.dimensions' => trans('web.image.dimensions'),
        ];
    }
}
