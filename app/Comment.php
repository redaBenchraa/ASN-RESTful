<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function containingPost(){
        return $this->belongsTo('App\Post','Post_id');
    }
    public function commentedBy(){
        return $this->belongsTo('App\Account','Account_id');
    }
    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_comment','Comment_id','Account_id');
    }
}
