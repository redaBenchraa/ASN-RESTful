<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function containedComments(){
        return $this->hasMany('App\Comment','Comment_id');
    }

    public function postedBy(){
        return $this->belongsTo('App\account','Account_id');
    }

    public function containingGrp(){
        return $this->belongsTo('App\Grp','Grp_id');
    }

    public function relatedNotification(){
        return $this->hasMany('App\Notification','Notification_id');
    }

    public function containedPolls(){
        return $this->hasMany('App\Poll','Poll_id');
    }

    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_post','Post_id','Account_id');
    }
}
