<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 19:01
 */

namespace App\Services\v1;


class serviceBP
{
    protected $supportedFields = [
        'createGroup' => 'myGroups',
        'participateInConversation' => 'conversations',
        'administrate' => 'administratedGroups',
        'belongsToGroup' => 'groups',
        'Post' => 'posts',
        'sendMessage' => 'sentMessages',
        'receiveMessageNotification' => 'messageNotifications',
        'receiveNotification' => 'notifications'
    ];
    protected $clauseProprieties = [
        'id' => 'id',
        'firstName' => 'firstName',
        'lastName' => 'lastName',
        'Email' => 'Email',
        'showEmail' => 'showEmail',
        'xCoordinate' => 'xCoordinate',
        'yCoordinate' => 'yCoordinate',
    ];
    protected function getWhereClauses($params){
        $clause = [];
        foreach ($this->clauseProprieties as $keys =>$propriety){
            if(in_array($propriety,array_keys($params))){
                $clause[$keys] = $params[$propriety];
            }
        }
        return  $clause;
    }
    protected function getWithKeys($params){
        $withKeys = [];
        if(isset($params['include'])){
            $includes = [];
            $includeParams = explode(',',$params['include']);
            $includes = array_intersect($this->supportedFields,$includeParams);
            $withKeys = array_keys($includes);
        }
        return  $withKeys;
    }

    protected function getAccountRoute($Account){
        return route('Accounts.show',['id'=>$Account->id]);
    }
    protected function getCommentRoute($Comment){
        return route('Comment.show',['id'=>$Comment->id]);
    }
    protected function getConversationRoute($Conversation){
        return route('Conversation.show',['id'=>$Conversation->id]);
    }
    protected function getGrpRoute($Grp){
        return route('Groups.show',['id'=>$Grp->id]);
    }
    protected function getMessageRoute($Message){
        return route('Messages.show',['id'=>$Message->id]);
    }
    protected function getMessageNotificationRoute($MessageNotification){
        return route('MessageNotifications.show',['id'=>$MessageNotification->id]);
    }
    protected function getNotificationRoute($Notification){
        return route('Notifications.show',['id'=>$Notification->id]);
    }
    protected function getPollRoute($Poll){
        return route('Polls.show',['id'=>$Poll->id]);
    }
    protected function getPostRoute($Post){
        return route('Posts.show',['id'=>$Post->id]);
    }

}