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

    protected $tableFields = ['Seen'];

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

    public function createNotification($req){
        $notification = new Notification();
        $notification->Content = $req->input('Content');
        $notification->Seen = $req->input('Seen');
        $notification->dateAndTime = $req->input('dateAndTime');
        $notification->Account_id = $req->input('Account_id');
        $notification->Post_id = $req->input('Post_id');
        $notification->save();
        return $notification;
    }
    public function updateNotification($req,$id){
        $notification = Notification::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $notification->fill([$field => $req[$field]]);
            }
        }
        $notification->save();
        return $notification;
    }
    public function deleteNotification($id){
        $notification = Notification::find($id)->delete();
    }
}