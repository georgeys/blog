<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    //
    public $table = 'users';

    protected $fillable = ['name','email','password','avatar'];

    //用户文章
    public function posts()
    {
        return $this->hasMany('App\Post','user_id','id');
    }
    //我的粉丝
    public function fans()
    {
        return $this->hasMany(\App\fan::class,'star_id','id');
    }
    //我的关注
    public function stars()
    {
        return $this->hasMany(\App\fan::class,'fan_id','id');
    }
    //关注某人行为
    //uid为关注对象的id
    public function doFan($uid)
    {
        //直接调用stats添加
        $fan = new fan();
        $fan->star_id = $uid;
        $fan->fan_id  = Auth::id();
        return $this->stars()->save($fan);
    }
    //取消关注某人行为
    //uid为关注对象的id
    public function doUnFan($uid)
    {
        //直接调用stats添加
        $fan = new fan();
        $fan->star_id = $uid;
        $fan->fan_id  = Auth::id();
        return $this->stars()->delete($fan);
    }
    //当前用户是否被uid关注了
    //检查我是否被某个人粉了
    public function hasFan($uid)
    {
        return $this->fans()->where(['fan_id'=>$uid,'star_id'=>Auth::id()])->count();
    }
    //检查我是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where(['fan_id'=>Auth::id(),'star_id'=>$uid])->count();
    }


    public function comments()
    {
        return $this->hasMany('App\Comment','user_id','id');
    }



}
