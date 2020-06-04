<?php

namespace App;

use App\Model\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    //登录验证继承Authenticated
    /**
     * @var array
     */
    protected $fillable = ['name','password'];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
