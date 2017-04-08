<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function containAccount(){
        return $this->belongsToMany('App\Account','account_conversation');
    }

    public function containMessage(){
        return $this->hasMany('App\Message','idMessage');
    }
}
