<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    // 用户个人信息
    public function me(Request $request)
    {
        $user = new UserResource(Auth::user());
        return $this->success($user);
    }

    // 更新用户基本信息
    public function update(UserRequest $request)
    {
        $updateData = [];
        if ($request->name) {
            $updateData['name'] = $request->name;
        }

        if ($request->email) {
            $updateData['email'] = $request->email;
        }

        if ($request->password) {
            $updateData['password'] = bcrypt($request->password);
        }

        $user = Auth::user();

        $user->update($updateData);
        return $this->success(new UserResource($user));
    }
}
