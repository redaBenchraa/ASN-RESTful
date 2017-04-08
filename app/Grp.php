<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grp extends Model
{
    public function createGroup(){
        return $this->belongsTo('App\Account','idAccount');
    }
    public function haveSuperGroup(){
        return $this->belongsTo('App\Grp','idGroup');
    }

    public function containMembers(){
        return $this->hasMany('App\Account','idAccount');
    }
}
