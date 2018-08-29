<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Traits\PassportToken;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;

class AuthorizationsController extends Controller
{
    use PassportToken;
    // 用户用手机号 验证码 登录/注册 返回 token
    public function store(AuthorizationRequest $request)
    {
        $verification_key = $request->verification_key;

        $verification = Cache::get($verification_key);

        if (!$verification) {   // 验证码过期
           return $this->failed(trans('web.sms_code_expired'));
        }

        $verification_code = $request->verification_code;
        if (!hash_equals($verification_code, $verification['code'])) {
            // 验证码不正确
            return $this->failed(trans('web.sms_code_invalid'));
        }

        $phone = $verification['phone'];

        // 查询用户信息，已存在用户直接登录，未存在的注册并登录
        $user = User::query()->where('phone', $phone)->first();

        if (!$user) {
            // 创建用户数据
            $user = User::create([
                'phone' => $phone,
            ]);
        }

        // 根据用户数据获取token
        $token_res =  $this->getBearerTokenByUser($user, '3', false);

        // 返回 token

        return $this->success($token_res);

    }

    // 刷新 token
    public function update(AuthorizationServer $server, ServerRequestInterface $serverRequest)
    {
        try {
            $token_res = $server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
            return $this->success($token_res);
        } catch (OAuthServerException $exception) {
            return $this->failed($exception->getMessage());
        }

    }
}
