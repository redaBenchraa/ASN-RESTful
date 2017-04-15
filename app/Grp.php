<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grp extends Model
{
    public function createdBy(){
        return $this->belongsTo('App\Account','Account_id');
    }

    public function haveSuperGroup(){
        return $this->belongsTo('App\Grp','Grp_id');
    }

    public function haveSubGroup(){
        return $this->hasMany('App\Grp','Grp_id');
    }

    public function contain(){
        return $this->hasMany('App\Post','Grp_id');
    }

    public function administratedBy(){
        return $this->belongsToMany('App\Account','account_grp','Grp_id','Account_id');
    }

    public function containMembers(){
        return $this->belongsToMany('App\Account','grp_account','Grp_id','Account_id');
    }
    protected $fillable = ['Name','creationDate','Image','About','Account_id','Grp_id'];

}
