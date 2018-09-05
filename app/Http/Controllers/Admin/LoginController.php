<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InvalidException;
use App\Http\Requests\AdminUserRequest;
use App\Services\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
      return view('admin.login');
    }

    // 执行登录
    public function store(AdminUserRequest $request)
    {
        //$username = $request->username;
        //$password = $request->password;

        //return $request;

        $bool = Auth::guard('admin')->attempt($request->only('username','password'));

        if ($bool) {

            

            return Admin::user();
        }

        // 登录失败
        throw new InvalidException('账号密码错误!');
    }


}
