<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grp extends Model
{
    public function createdBy(){
        return $this->belongsTo('App\Account','idAccount');
    }

    public function haveSuperGroup(){
        return $this->belongsTo('App\Grp','idGroup');
    }

    public function haveSubGroup(){
        return $this->hasMany('App\Grp','idGroup');
    }

    public function containMembers(){
        return $this->belongsToMany('App\Account','account_grp');
    }

    public function administratedBy(){
        return $this->belongsToMany('App\Account','grp_account');
    }

    public function contain(){
        return $this->hasMany('App\Post','idPost');
    }
}
