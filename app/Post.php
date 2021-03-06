<?php

namespace App;

use App\Model\Model;
use Illuminate\Database\Eloquent\Builder;

//继承了自定义modelprotected $guarded=[];所有都可以写入
class Post extends Model
{


    //关联评论
    public function comments()
    {
        return $this->hasMany('App\Comment')
            ->orderBy('created_at','desc');
    }
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User' ,'user_id', 'id');
    }
    //赞
    public function zan($user_id)
    {
        return  $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //
    public function zans()
    {
        return $this->hasMany('App\Zan');
    }
    //
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }
    //属于一个作者的文章
    public function scopeAuthorBy(Builder $query,$user_id)
    {
        return $query->where("user_id" ,$user_id);
    }
    //不属于某个专题的文章
    //use调用传过来的$topic_id
    public function scopeTopicNotBy(Builder $query,$topic_id)
    {
        return $query->doesntHave('postTopics','and',function($q) use ($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }
    //全局scope的方式（审核未通过文章不显示）//
    protected static function boot()
    {
        parent::boot(); //
        static::addGlobalScope('avaiable',function (Builder $builder){
            $builder->where('status',[0,1]);
        });
    }

}
