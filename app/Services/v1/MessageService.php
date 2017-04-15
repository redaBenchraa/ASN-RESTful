<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 20:10
 */

namespace App\Services\v1;


use App\Message;

class MessageService extends serviceBP {

    protected $supportedFields = [
        'sentBy' => 'account',
        'belongsToConversation' => 'conversation',
    ];

    protected $clauseProprieties = [
        'id' => 'id',
        'created_at' => 'date',
        'Account_id' => 'account',
        'Conversation_id' => 'conversation',
    ];
    public function getMessages($params){
        $withKeys = [];
        if(empty($params)){
            return $this->filterMessages(Message::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Messages = Message::with($withKeys)->where($whereClauses)->get();
        return $this->filterMessages($Messages,$withKeys);
    }
    protected function filterMessages($Messages,$withKeys){
        $data = [];
        foreach ($Messages as $Message){
            $entry = [
                'id' => $Message->id,
                'Content' => $Message->Content,
                'date' => $Message->created_at,
                'account' => $Message->Account_id,
                'conversation' => $Message->Conversation_id,
                'href' => route('Messages.show',['id'=>$Message->id]),
            ];
            if(in_array('sentBy',$withKeys)){
                $Account = $Message->sentBy;
                $entry['Account'] = [
                    'id' => $Account->id,
                    'firstName' => $Account->firstName,
                    'lastName' => $Account->lastName,
                    'About' => $Account->About,
                    'Image' => $Account->Image,
                    'Email' => $Account->Email,
                    'showEmail' => $Account->showEmail,
                    'xCoordinate' => $Account->xCoordinate,
                    'yCoordinate' => $Account->yCoordinate,
                ];
            }
            if(in_array('belongsToConversation',$withKeys)){
                $Conversation = $Message->belongsToConversation;
                $entry['Conversation'] = [
                    'id' => $Conversation->id,
                    'lastMessage' => $Conversation->containMessage->pluck('Content')->first(),
                ];

            }
            $data[] = $entry;
        }
        return $data;
    }

}