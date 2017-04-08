<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageNotification extends Model
{
    public function relatesToMessage(){
        return $this->belongsTo('App\Message','idMessage');
    }

    public function sentTo(){
        return $this->belongsTo('App\Account','idAccount');
    }
}
