<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function containedComments(){
        return $this->hasMany('App\Comment','idComment');
    }

    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_post');
    }

    public function postedBy(){
        return $this->belongsTo('App\account','idAccount');
    }

    public function containingGrp(){
        return $this->belongsTo('App\Grp','idGroup');
    }

    public function relatedNotification(){
        return $this->hasMany('App\Notification','idNotification');
    }

    public function containedPolls(){
        return $this->hasMany('App\Poll','idPoll');
    }
}
