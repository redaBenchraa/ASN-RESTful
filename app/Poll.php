<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function containingPost(){
        return $this->belongsTo('App\Post','idPost');
    }

    public function voters(){
        return $this->belongsToMany('App\Account','account_poll');
    }
}
