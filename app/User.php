<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    //
    public $table = 'user';

    protected $fillable = ['id','name','email','password','remember_token',
        'create_at','updated_at','avatar'];
}
