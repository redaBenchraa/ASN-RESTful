<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function containingPost(){
        return $this->belongsTo('App\Post');
    }
    public function commentedBy(){
        return $this->belongsTo('App\Account');
    }
    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_comment','Comment_id','Account_id');
    }
}
