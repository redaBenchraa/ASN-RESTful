<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function receiveNotification(){
        return $this->hasMany('App\Notification','idNotification');
    }

    public function receiveMessageNotification(){
        return $this->hasMany('App\Notification','idNotification');
    }

    public function sendMessage(){
        return $this->hasMany('App\Message','idMessage');
    }

    public function participateInConversation(){
        return $this->belongsToMany('App\Conversation','account_conversation');
    }

    public function voteInPoll(){
        return $this->belongsToMany('App\Poll','account_poll');
    }

    public function reactInComment(){
        return $this->belongsToMany('App\Comment','account_comment');
    }

    public function Comment(){
        return $this->hasMany('App\Comment','idComment');
    }

    public function reactsInPost(){
        return $this->belongsToMany('App\Post','account_post');
    }

    public function Post(){
        return $this->hasMany('App\Post','idPost');
    }

    public function createGroup(){
        return $this->hasMany('App\Grp','idGroup');
    }

    public function administrate(){
        return $this->belongsToMany('App\Grp','account_grp');
    }

    public function belongsToGroup(){
        return $this->belongsToMany('App\Grp','grp_account');
    }




}
