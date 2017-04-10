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
        foreach ($this->clauseProprieties as $propriety){
            if(in_array($propriety,array_keys($params))){
                $clause[$propriety] = $params[$propriety];
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
}