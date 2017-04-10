<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function containingPost(){
        return $this->belongsTo('App\Post','Post_id');
    }

    public function voters(){
        return $this->belongsToMany('App\Account','account_poll','Poll_id','Account_id');
    }
}
