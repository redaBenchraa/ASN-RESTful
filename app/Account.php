<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function receiveNotification(){
        return $this->hasMany('App\Notification','Account_id');
    }

    public function receiveMessageNotification(){
        return $this->hasMany('App\MessageNotification','Account_id');
    }

    public function sendMessage(){
        return $this->hasMany('App\Message','Account_id');
    }

    public function Comment(){
        return $this->hasMany('App\Comment','Account_id');
    }

    public function Post(){
        return $this->hasMany('App\Post','Account_id');
    }

    public function createGroup(){
        return $this->hasMany('App\Grp','Account_id');
    }

    public function participateInConversation(){
        return $this->belongsToMany('App\Conversation','account_conversation','Account_id','Conversation_id');
    }

    public function voteInPoll(){
        return $this->belongsToMany('App\Poll','account_poll','Account_id','Poll_id');
    }

    public function reactInComment(){
        return $this->belongsToMany('App\Comment','account_comment','Account_id','Comment_id');
    }

    public function reactsInPost(){
        return $this->belongsToMany('App\Post','account_post','Account_id','Post_id');
    }

    public function administrate(){
        return $this->belongsToMany('App\Grp','account_grp','Account_id','Grp_id');
    }

    public function belongsToGroup(){
        return $this->belongsToMany('App\Grp','grp_account','Account_id','Grp_id');
    }
}
