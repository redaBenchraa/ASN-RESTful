<?php
/**
 * Created by PhpStorm.
 * User: Rabab Chahboune
 * Date: 4/10/2017
 * Time: 9:51 PM
 */

namespace App\Services\v1;
use App\MessageNotification;
use App\Account;
class MessageNotificationService extends serviceBP
{

    protected $supportedFields = [
        'relatesToMessage' => 'message',
        'sentTo' => 'receiver',
    ];

    protected $clauseProprieties = [
        'id' => 'id',
        'seen' => 'seen',
        'Message_Id' => 'message',
        'Account_id' => 'account',
    ];
    protected $tableFields = ['Seen'];

    public function getMessageNotifications($params)
    {
        $withKeys = [];
        if (empty($params)) {
            echo 'here';
            return $this->filterMessageNotifications(MessageNotification::all(), $withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $MessageNotifications = MessageNotification::with($withKeys)->where($whereClauses)->get();
        return $this->filterMessageNotifications($MessageNotifications, $withKeys);
    }

    protected function filterMessageNotifications($MessageNotifications, $withKeys)
    {
        $data = [];
        foreach ($MessageNotifications as $messageNotification) {
            $entry = [
                'id' => $messageNotification->id,
                'Content' => $messageNotification->Content,
                'Seen' => $messageNotification->Seen,
            ];
            if (in_array('relatesToMessage', $withKeys)) {
                $entry ['message'] = $messageNotification->relatesToMessage;
            }

            if (in_array('sentTo', $withKeys)) {
                $entry ['receiver'] = $messageNotification->sentTo;

            }
            $data [] = $entry;
        }
        return $data;
    }

    public function createMessageNotification($req){
        $messageNotification = new MessageNotification();
        $messageNotification->Content = $req->input('Content');
        $messageNotification->Seen = $req->input('Seen');
        $messageNotification->Account_id = $req->input('Account_id');
        $messageNotification->Message_id = $req->input('Message_id');
        $messageNotification->save();
        return $messageNotification;
    }
    public function updateMessageNotification($req,$id){
        $messageNotification = MessageNotification::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $messageNotification->fill([$field => $req[$field]]);
            }
        }
        $messageNotification->save();
        return $messageNotification;
    }
    public function deleteMessageNotification($id){
        $messageNotification = MessageNotification::find($id)->delete();
    }
}