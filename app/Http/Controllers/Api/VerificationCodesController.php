<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
//use Illuminate\Contracts\Validation\Validator;
use Validator;


class VerificationCodesController extends Controller
{
//    protected function formatValidationErrors(Validator $validator)
//    {
//        $message = $validator->errors()->first();
//        return ['message' => $message, 'code' => 500];
//    }
    //
    public function store(VerificationCodeRequest $request)
    {
//        $validator = Validator::make($request->all(),[
//            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users',
//        ]);
//
//        dd($validator->errors());

        $phone = $request->phone;
        // 生成 4 位随机数
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT );
        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);  // 设置10分钟后过期

//        Cache::put($key,[
//            'phone' => $phone,
//            'code'  => $code,
//        ], $expiredAt);

        //return ['key' => $key, 'phone' => $phone];
        return response()->json(['key' => $key], 200, []);
    }
}
