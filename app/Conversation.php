<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function containMessage(){
        return $this->hasMany('App\Message','Conversation_id');
    }

    public function containAccount(){
        return $this->belongsToMany('App\Account','account_conversation','Conversation_id','Account_id');
    }
}
