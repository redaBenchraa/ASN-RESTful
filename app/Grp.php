<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grp extends Model
{
    public function createdBy(){
        return $this->belongsTo('App\Account');
    }

    public function haveSuperGroup(){
        return $this->belongsTo('App\Grp');
    }

    public function haveSubGroup(){
        return $this->hasMany('App\Grp');
    }

    public function contain(){
        return $this->hasMany('App\Post');
    }

    public function containMembers(){
        return $this->belongsToMany('App\Account','grp_account', 'Grp_id','Account_id');
    }

    public function administratedBy(){
        return $this->belongsToMany('App\Account','account_grp','Grp_id','Account_id');
    }
}
