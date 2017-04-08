<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sentBy(){
        return $this->belongsTo('App\Account','idAccount');
    }

    public function belongsToConversation(){
        return $this->belongsTo('App\Conversation','idConversation');
    }

    public function relatedToNotification(){
        return $this->hasMany('App\MessageNotification','idMessageNotification');
    }

}
