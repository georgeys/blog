<?php

namespace App;

use App\Model\Model;

class Topic extends Model
{
    //属于这个专题的所有文章
    public function posts()
    {
        //多对多链接
        //1、关联的标的模型\App\Post::class
        //2、中间的关联表名
        //3、和当前模型关联的外键（二表与当前模型标的关联外键）
        //4、二表与仪表的关联外键
        return $this->belongsToMany(\App\Post::class,'post_topics',
            'topic_id','post_id');
    }
    //专题的文章数（2中方法）上面加上count
    public function postTopics()
    {
        $this->hasMany(\App\Post::class,'topic_id','id');
    }
}
