<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function receivedBy(){
        return $this->belongsTo('App\Account');
    }

    public function relatesToPost(){
        return $this->belongsTo('App\Post');
    }
}
