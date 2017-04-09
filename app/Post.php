<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function containedComments(){
        return $this->hasMany('App\Comment');
    }

    public function postedBy(){
        return $this->belongsTo('App\account');
    }

    public function containingGrp(){
        return $this->belongsTo('App\Grp');
    }

    public function relatedNotification(){
        return $this->hasMany('App\Notification');
    }

    public function containedPolls(){
        return $this->hasMany('App\Poll');
    }

    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_post','Post_id','Account_id');
    }
}
