<?php
/**
 * Created by PhpStorm.
 * User: Rabab Chahboune
 * Date: 4/9/2017
 * Time: 9:58 PM
 */

namespace App\Services\v1;

use App\Grp;
use App\Account;
use App\Http\Controllers\v1\AccountController;


class GrpsServices extends serviceBP {
    protected $supportedFields = [
        'createdBy' => 'owner',
        'administratedBy' => 'admins',
        'containMembers' => 'members',
        'contain' => 'posts',
    ];

    protected $clauseProprieties = [
        'id' => 'id',
        'Account_id' => 'owned'
        //super group
    ];

    public function getGrps($params){
            $withKeys = [];
            if(empty($params)){
                return $this->filterGrps(Grp::all(),$withKeys);
            }
            $withKeys = $this->getWithKeys($params);
            $whereClauses = $this->getWhereClauses($params);
            $Grps = Grp::with($withKeys)->where($whereClauses)->get();
            return $this->filterGrps($Grps,$withKeys);
    }

    protected function filterGrps($Grps,$withKeys){
        $data = [];
        foreach ($Grps as $Grp){
            $entry = [
                'id' => $Grp->id,
                'Name' => $Grp->Name,
                'Image' => $Grp->Image,
                'About' => $Grp->About,
                'CreationDate' => $Grp->creationDate,
                'href' => route('Groups.show',['id'=>$Grp->id]),
            ];
            if(in_array('createdBy',$withKeys)){
                $groupOwner = $Grp->createdBy;
                $entry['owner'] = [
                    // 'id' => $groupOwner->id,
                    // 'firstName' => $groupOwner->firstName,
                    // 'lastName' => $groupOwner->lastName,
                    //'href' => $groupOwner->route('Accounts.show',['id'=>$groupOwner->id]),
                    'id' => $groupOwner->id,
                    'firstName' => $groupOwner->firstName,
                    'lastName' => $groupOwner->lastName,
                    'Email' => $groupOwner->Email,
                    'About' => $groupOwner->About,
                    'showEmail' => $groupOwner->showEmail,
                    'Image' => $groupOwner->Image,
                    'xCoordinate' => $groupOwner->xCoordinate,
                    'yCoordinate' => $groupOwner->yCoordinate,
                ];
            }

            if(in_array('administratedBy',$withKeys)){
                $Admins = $Grp->administratedBy;
                $AdminsList = [];
                foreach ($Admins as $Admin) {
                    $anAdmin = [
                        //'id' => $Admin->id,
                        //'firstName' => $Admin->firstName,
                        //'lastName' => $Admin->lastName,
                        'id' => $Admin->id,
                        'firstName' => $Admin->firstName,
                        'lastName' => $Admin->lastName,
                        'Email' => $Admin->Email,
                        'About' => $Admin->About,
                        'showEmail' => $Admin->showEmail,
                        'Image' => $Admin->Image,
                        'xCoordinate' => $Admin->xCoordinate,
                        'yCoordinate' => $Admin->yCoordinate,                       
                       // 'href' => $Admin->route('Accounts.show',['id'=>$Admin->id]),
                    ];
                    $AdminsList[] = $anAdmin;
                }
                $entry['admins'] = $AdminsList;
            }
            if(in_array('containMembers',$withKeys)){
                $Members = $Grp->containMembers;
                $MembersList = [];
                foreach ($Members as $member) {
                    $aMember = [
                        //'id' => $member->id,
                        //'firstName' => $member->firstName,
                        //'lastName' => $member->lastName,
                        // 'href' => $member->route('Accounts.show',['id'=>$Admin->id]),
                        'id' => $member->id,
                        'firstName' => $member->firstName,
                        'lastName' => $member->lastName,
                        'Email' => $member->Email,
                        'About' => $member->About,
                        'showEmail' => $member->showEmail,
                        'Image' => $member->Image,
                        'xCoordinate' => $member->xCoordinate,
                        'yCoordinate' => $member->yCoordinate,
                    ];
                    $MembersList[] = $aMember;
                }
                $entry['members'] = $MembersList;
            }
            if(in_array('contain',$withKeys)){
                $Posts = $Grp->contain;
                $PostsList = [];
                foreach ($Posts as $post) {
                    $Account = $post->postedBy;
                    $Polls = $post->containedPolls;
                    $PollsList = [];
                    foreach ($Polls as $poll) {
                        $pollOption = [
                            'id'=>$poll->id,
                            'Content'=>$poll->Content,
                            'Vote'=>$poll->Vote,
                        ];

                        $PollsList[] = $pollOption;
                    }
                   $Comments = $post->containedComments->count();
                    $aPost = [
                        'id'=>$post->id,
                        'content'=>$post->content,
                        'Image'=>$post->Image,
                        'File'=>$post->File,
                        'Type'=>$post->Type,
                        'postingDate'=>$post->postingDate,
                        'popularity' =>$post->popularity,
                        'poster'=>$Account,
                        'polls' => $PollsList,
                        'comments'=> $Comments

                    ];
                    $PostsList[] = $aPost;
                }
                $entry['posts'] = $PostsList;
            }


            $data[] = $entry;
        }
        return $data;
    }
}