<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sentBy(){
        return $this->belongsTo('App\Account');
    }

    public function belongsToConversation(){
        return $this->belongsTo('App\Conversation');
    }

    public function relatedToNotification(){
        return $this->hasMany('App\MessageNotification');
    }

}
