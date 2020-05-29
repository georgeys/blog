<?php

namespace App;

use App\Model\Model;

class Zan extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }

}
