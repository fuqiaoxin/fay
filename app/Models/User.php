<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // 填充字段
    protected $fillable = ['name', 'phone','email','password','avatar_id'];

    //
    protected $hidden = ['password','remember_token'];

    public function findForPassport($username)
    {
        // 判断 $username 参数 是邮箱格式就根据 email 字段判断，否则就根据 phone 字段来查询用户
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;
        return self::where($credentials)->first();
    }

    public function setAvatarAttribute()
    {
        $avatar = $this->avatar()->path;

        $this->attributes['avatar'] = $avatar;
    }

    public function avatar()
    {
        return $this->hasOne(Image::class)->withDefault(function ($image) {
            $image->id = $this->id;
        });
    }
}
