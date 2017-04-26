<?php

namespace App\Services\v1;

use App\Account;

class AccountsService extends serviceBP {

    protected $supportedFields = [
        'belongsToGroup' => 'groups',
        'administrate' => 'administratedGroups',
        'createGroup' => 'myGroups',
        'participateInConversation' => 'conversations',
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
    protected  $tableFields = ['firstName','lastName','Email','About','showEmail','Image','xCoordinate','yCoordinate'];
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
                'xCoordinate' => $Account->xCoordinate,
                'yCoordinate' => $Account->yCoordinate,
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
                    $messageList[] = $Message;
                }
                $entry['sentMessages'] = $messageList;
            }
            if(in_array('Post',$withKeys)){
                $Posts= $Account->Post;
                $postList = [];
                foreach ($Posts as $Post) {
                    $postList[] = $Post;
                }
                $entry['posts'] = $postList;
            }
            if(in_array('belongsToGroup',$withKeys)){
                $Groups = $Account->belongsToGroup;
                $groupsItem = [];
                foreach ($Groups as $Group) {
                    $groupsItem[] = $Group;
                }
                $entry['groups'] = $groupsItem;
            }
            if(in_array('administrate',$withKeys)){
                $Groups = $Account->administrate;
                $administratedGroups =[];
                foreach ($Groups as $Group) {
                    $grp = [
                        'id' => $Group->id,
                        'Name' => $Group->Name,
                        'About' => $Group->About,
                        'creationDate' =>$Group->creationDate
                    ];
                    $administratedGroups[] = $grp;
                }
                $entry['administratedGroups'] = $administratedGroups;
            }
            if(in_array('createGroup',$withKeys)){
                $Groups = $Account->createGroup;
                $createdGroups =[];
                foreach ($Groups as $Group) {
                    $grp = $Group;
                    $createdGroups[] = $grp;
                }
                $entry['createdGroups'] = $createdGroups;
            }
            if(in_array('participateInConversation',$withKeys)){
                $Conversations = $Account->participateInConversation;
                $conversationList =[];
                foreach ($Conversations as $conversation) {
                    $Accounts = [];
                    $Messages = [];
                    foreach ($conversation->containAccount as $Account){
                        $accountItem = $Account;
                        $Accounts[]= $accountItem;

                    }
                    foreach ($conversation->containMessage as $Message){
                        $messageItem = $Message;
                        $Messages[]= $messageItem;

                    }
                    $conversationItem = [
                        'id' => $conversation->id,
                        'accounts' =>$Accounts,
                        'messages' =>$Messages,
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

    public function createAccount($req){
        $account = new Account();
        $account->firstName = $req->input('firstName');
        $account->lastName = $req->input('lastName');
        $account->Email = $req->input('Email');
        $account->Password = $req->input('password');
        $account->About = $req->input('About');
        $account->showEmail = $req->input('showEmail');
        $account->Image = $req->input('Image');
        $account->xCoordinate = $req->input('xCoordinate');
        $account->yCoordinate = $req->input('yCoordinate');
        $account->save();
        return $account;
    }

    public function updateAccount($req,$id){
        $account = Account::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $account->fill([$field => $req[$field]]);
            }
        }
        $account->save();
        return $account;
    }
    public function deleteAccount($id){
        Account::find($id)->delete();
    }
    public function searchMembers($search){
        $data = [];
        $accounts =  Account::where(function ($query) use($search) {
            $query->where('Email', 'like', $search."%")
                ->orwhere('firstName', 'like', $search."%")
                ->orwhere('lastName', 'like', $search."%");
        })->take(30)->get();
        foreach ($accounts as $account){
            $data[] = $account;
        }
        return $data;
    }

}
