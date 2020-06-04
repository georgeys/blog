<?php

namespace App;

use App\Model\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //登录验证继承Authenticated
    protected $fillable = ['name','password','remember_token'];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
