<?php
namespace App\Services;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: fay
 * Date: 2018/8/30
 * Time: 下午5:19
 */
class Admin
{
    public static function user()
    {
       return Auth::guard('admin')->user();
    }
}