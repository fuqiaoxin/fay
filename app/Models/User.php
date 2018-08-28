<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // 填充字段
    protected $fillable = ['name', 'phone','email','password'];

    //
    protected $hidden = ['password','remember_token'];
}
