<?php
/**
 * Created by PhpStorm.
 * User: Rabab Chahboune
 * Date: 4/10/2017
 * Time: 11:29 PM
 */

namespace App\Services\v1;
use App\Notification;


class NotificationService extends serviceBP{
    protected $supportedFields = [
        'receivedBy' => 'receiver',
        'relatesToPost' => 'post',
    ];
    protected $clauseProprieties = [
        'id' => 'id',
        'seen' => 'seen',
        'Post_id' => 'post',
        'account_id' => 'account'
    ];

    public function getNotifications($params){
        $withKeys = [];
        if(empty($params)){
            return $this->filterNotifications(Notification::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Notifications = Notification::with($withKeys)->where($whereClauses)->get();
        return $this->filterNotifications($Notifications,$withKeys);
    }

    protected function filterNotifications($Notifications,$withKeys)
    {
        $data = [];
        foreach ($Notifications as $notification) {
            $entry = [
                'id' => $notification->id,
                'Content' => $notification->Content,
                'dateAndTime' => $notification->dateAndTime,
                'Seen' => $notification->Seen,
            ];

            if (in_array('receivedBy', $withKeys)) {
                $entry['receiver'] = $notification->receivedBy;
            }
            if (in_array('relatesToPost', $withKeys)) {
                $entry['post'] = $notification->relatesToPost;
            }
            $data [] = $entry;
        }
        return $data;
    }
}