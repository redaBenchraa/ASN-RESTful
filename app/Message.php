<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sentBy(){
        return $this->belongsTo('App\Account','Account_id');
    }

    public function belongsToConversation(){
        return $this->belongsTo('App\Conversation','Conversation_id');
    }

    public function relatedToNotification(){
        return $this->hasMany('App\MessageNotification','MessageNotification_id');
    }

}
