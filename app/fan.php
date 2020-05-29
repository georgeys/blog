<?php

namespace App;

use App\Model\Model;

class fan extends Model
{
    //粉丝用户
    public function fuser()
    {
        return $this->hasOne('\App\User','id','fan_id');
    }
    //被关注用户
    public function suser()
    {
        return $this->hasOne('\App\User','id','start_id');
    }
}
