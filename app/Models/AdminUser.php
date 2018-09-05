<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model implements AuthenticatableContract
{
    use Authenticatable;
    public $fillable = ['username', 'password', 'name', 'avatar', 'remember_token'];
    public $hidden = ['password', 'remember_token'];

}
