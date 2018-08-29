<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{

    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $phone = $request->phone;
        // 生成 4 位随机数
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT );
        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);  // 设置10分钟后过期


        // 调用发短信方法
        if (app()->environment() == 'production') {
            try {
                $message = trans('web.sms', [':code' => $code]);
                $easySms->send($phone, $message);
            } catch (ClientException $exception) {
                // 出错了，未发出去
                //$error = \GuzzleHttp\json_decode($exception->getResponse()->getBody()->getContents(), true);
                return $this->failed($exception->getMessage());
            }
        } else {
            $code = '1234';
        }

        Cache::put($key,[
            'phone' => $phone,
            'code'  => $code,
        ], $expiredAt);

        return $this->success(['verification_key' => $key]);
    }
}
