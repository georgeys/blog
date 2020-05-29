<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    public $table = 'users';

    protected $fillable = ['name','email','password','avatar'];

    public function posts()
    {
        return $this->hasMany('App\Post','user_id','id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','user_id','id');
    }
}
