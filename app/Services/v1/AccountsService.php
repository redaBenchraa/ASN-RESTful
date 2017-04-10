<?php

namespace App\Services\v1;

use App\Account;

class AccountsService extends serviceBP {

    protected $supportedFields = [
        'createGroup' => 'myGroups',
        'participateInConversation' => 'conversations',
        'administrate' => 'administratedGroups',
        'belongsToGroup' => 'groups',
        'Post' => 'posts',
        'sendMessage' => 'sentMessages',
        'receiveMessageNotification' => 'messageNotifications',
        'receiveNotification' => 'notifications',
        'reactsInPost' => 'reactInPost',
        'reactInComment' => 'reactInComment',
        'voteInPoll' => 'voteInPoll',
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
    public function getAccounts($params){
        $withKeys = [];
        if(empty($params)){
            return $this->filterAccounts(Account::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Accounts = Account::with($withKeys)->where($whereClauses)->get();
        return $this->filterAccounts($Accounts,$withKeys);
    }
    protected function filterAccounts($Accounts,$withKeys){
        $data = [];
        foreach ($Accounts as $Account){
            $entry = [
                'id' => $Account->id,
                'firstName' => $Account->firstName,
                'lastName' => $Account->lastName,
                'Email' => $Account->Email,
                'About' => $Account->About,
                'showEmail' => $Account->showEmail,
                'Image' => $Account->Image,
                'href' => route('Accounts.show',['id'=>$Account->id]),
            ];
            if(in_array('receiveNotification',$withKeys)){
                $Notifications= $Account->receiveNotification;
                $notificationsList = [];
                foreach ($Notifications as $Notification) {
                    $notificationItem = [
                        'id' => $Notification->id,
                        'Content' => $Notification->Content,
                        'Message_id' =>  $Notification->Post_id,
                        'seen' =>$Notification->Seen,
                        'date' =>$Notification->created_at,
                    ];
                    $notificationsList[] = $notificationItem;
                }
                $entry['notifications'] = $notificationsList;
            }
            if(in_array('receiveMessageNotification',$withKeys)){
                $messageNotifications= $Account->receiveMessageNotification;
                $messageNotificationList = [];
                foreach ($messageNotifications as $messageNotification) {
                    $messageNotificationItem = [
                        'id' => $messageNotification->id,
                        'Content' => $messageNotification->Content,
                        'Message_id' =>  $messageNotification->Message_id,
                        'seen' =>$messageNotification->Seen,
                        'date' =>$messageNotification->created_at,
                    ];
                    $messageNotificationList[] = $messageNotificationItem;
                }
                $entry['messageNotifications'] = $messageNotificationList;
            }
            if(in_array('sendMessage',$withKeys)){
                $Messages= $Account->sendMessage;
                $messageList = [];
                foreach ($Messages as $Message) {
                    $messageItem = [
                        'id' => $Message->id,
                        'Content' => $Message->Content,
                        'Conversation' =>  $Message->Conversation_id,
                        'date' =>$Message->created_at,
                    ];
                    $messageList[] = $messageItem;
                }
                $entry['sentMessages'] = $messageList;
            }
            if(in_array('Post',$withKeys)){
                $Posts= $Account->Post;
                $postList = [];
                foreach ($Posts as $Post) {
                    $postItem = [
                        'id' => $Post->id,
                        'Content' => $Post->content,
                        'date' =>$Post->postingDate,
                        'popularity' =>$Post->popularity,
                        'File' =>$Post->File,
                        'Image' =>$Post->Image
                    ];
                    $postList[] = $postItem;
                }
                $entry['posts'] = $postList;
            }
            if(in_array('belongsToGroup',$withKeys)){
                $Groups = $Account->belongsToGroup;
                $administratedGroups =[];
                foreach ($Groups as $Group) {
                    $grp = [
                        'id' => $Group->id,
                        'Name' => $Group->Name,
                        'About' => $Group->About,
                        'createdDate' =>$Group->creationDate
                    ];
                    $administratedGroups[] = $grp;
                }
                $entry['groups'] = $administratedGroups;
            }
            if(in_array('administrate',$withKeys)){
                $Groups = $Account->administrate;
                $administratedGroups =[];
                foreach ($Groups as $Group) {
                    $grp = [
                        'id' => $Group->id,
                        'Name' => $Group->Name,
                        'About' => $Group->About,
                        'createdDate' =>$Group->creationDate
                    ];
                    $administratedGroups[] = $grp;
                }
                $entry['administratedGroups'] = $administratedGroups;
            }
            if(in_array('createGroup',$withKeys)){
                $Groups = $Account->createGroup;
                $createdGroups =[];
                foreach ($Groups as $Group) {
                    $grp = [
                        'Name' => $Group->Name,
                        'About' => $Group->About,
                        'createdDate' =>$Group->creationDate
                    ];
                    $createdGroups[] = $grp;
                }
                $entry['createdGroups'] = $createdGroups;
            }
            if(in_array('participateInConversation',$withKeys)){
                $Conversations = $Account->participateInConversation;
                $conversationList =[];
                $Accounts = [];
                foreach ($Conversations as $conversation) {
                    foreach ($conversation->containAccount as $Account){
                        $accountItem = [
                            "id" => $Account->id,
                            "firstName" => $Account->firstName,
                            "lastName" => $Account->lastName,
                        ];
                        $Accounts[]= $accountItem;

                    }
                    $conversationItem = [
                        'id' => $conversation->id,
                        'accounts' =>$Accounts,
                        'lastMessage' => $conversation->containMessage->pluck('Content')->first(),
                    ];
                    $conversationList[] = $conversationItem;
                }
                $entry['conversations'] = $conversationList;
            }
            if(in_array('reactsInPost',$withKeys)){
                $postReacts = $Account->reactsInPost;
                $postReactList =[];
                foreach ($postReacts as $postReact) {
                    $reactPostItem = [
                        'id' => $postReact->id,
                        'Post_type' => $postReact->pivot->type,
                    ];
                    $postReactList[] = $reactPostItem;
                }
                $entry['reactInPost'] = $postReactList;
            }
            if(in_array('reactInComment',$withKeys)){
                $postReacts = $Account->reactInComment;
                $postReactList =[];
                foreach ($postReacts as $postReact) {
                    $reactPostItem = [
                        'Comment_id' => $postReact->id,
                        'type' => $postReact->pivot->type,
                    ];
                    $postReactList[] = $reactPostItem;
                }
                $entry['reactInComment'] = $postReactList;
            }
            if(in_array('voteInPoll',$withKeys)){
                $postReacts = $Account->voteInPoll;
                $postReactList =[];
                foreach ($postReacts as $postReact) {
                    $reactPostItem =$postReact->id;
                    $postReactList[] = $reactPostItem;
                }
                $entry['voteInPoll'] = $postReactList;
            }

            $data[] = $entry;
        }
        return $data;
    }

}
