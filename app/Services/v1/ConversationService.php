<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 19:22
 */

namespace App\Services\v1;


use App\Conversation;

class ConversationService extends serviceBP {
    protected $supportedFields = [
        'containMessage' => 'messages',
        'containAccount' => 'accounts',

    ];
    protected $clauseProprieties = [
        'id' => 'id',
    ];
    
    public function getConversations($params){
        $withKeys = [];
        $whereClauses = [];
        if(empty($params)){
            return $this->filterConversations(Conversation::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Conversations = Conversation::with($withKeys)->where($whereClauses)->get();
        return $this->filterConversations($Conversations,$withKeys);
    }
    public function filterConversations($Conversations,$withKeys){
        $data = [];
        foreach ($Conversations as $Conversation){
            $entry = [
                'id' => $Conversation->id,
                'lastMessage' => $Conversation->containMessage->first(),
                'href' => route('Conversations.show',['id'=>$Conversation->id]),
            ];

            if(in_array('containMessage',$withKeys)){
                $Messages= $Conversation->containMessage;
                $messageList = [];
                foreach ($Messages as $Message) {
                    $messageItem = [
                        'id' => $Message->id,
                        'Content' => $Message->Content,
                        'Message_id' =>  $Message->id,
                        'date' =>$Message->created_at,
                    ];
                    $messageList[] = $messageItem;
                }
                $entry['messages'] = $messageList;
            }
            if(in_array('containAccount',$withKeys)){
                $Accounts= $Conversation->containAccount;
                $accountList = [];
                foreach ($Accounts as $Account) {
                    $accountItem = [
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
                    $accountList[] = $accountItem;
                }
                $entry['accounts'] = $accountList;
            }

            $data[] = $entry;
        }
        return $data;
    }
}