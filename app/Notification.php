<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function receivedBy(){
        return $this->belongsTo('App\Account','Account_id');
    }

    public function relatesToPost(){
        return $this->belongsTo('App\Post','Post_id');
    }

    protected $fillable = ['Seen'];
}
