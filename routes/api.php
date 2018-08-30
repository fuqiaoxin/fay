<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// 手机获取验证码 相同IP 1 分钟内只允许调用一次
Route::middleware('throttle:30,1')->post('/verificationCodes', 'VerificationCodesController@store')->name('api.verificationCodes.store');

// 获取 token
Route::post('/authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
// 刷新 token
Route::post('/authorizations/refresh', 'AuthorizationsController@update')->name('api.authorizations.update');

// 需要 验证的接口
Route::group([
    'middleware' => ['throttle','auth:api']
],function ($router) {
    // 当前用户的基本信息
    $router->get('/user','UsersController@me')->name('api.users.show');
    $router->post('/user/update', 'UsersController@update')->name('api.users.update');
    $router->post('/upload','FileUploadController@store')->name('api.file.upload');
});