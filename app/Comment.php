<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function containingPost(){
        return $this->belongsTo('App\Post','idPost');
    }
    public function commentedBy(){
        return $this->belongsTo('App\Account','idAccount');
    }
    public function reactingAccounts(){
        return $this->belongsToMany('App\Account','account_comment');
    }
}
