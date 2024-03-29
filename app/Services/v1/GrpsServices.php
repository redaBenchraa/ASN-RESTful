<?php
/**
 * Created by PhpStorm.
 * User: Rabab Chahboune
 * Date: 4/9/2017
 * Time: 9:58 PM
 */

namespace App\Services\v1;

use App\Grp;
use Carbon\Carbon;


class GrpsServices extends serviceBP {
    protected $supportedFields = [
        'createdBy' => 'owner',
        'administratedBy' => 'admins',
        'containMembers' => 'members',
        'pendingMembers' => 'requests',
        'contain' => 'posts',
        'haveSuperGroup' => 'super',
        'haveSubGroup' =>'subs'
    ];

    protected $clauseProprieties = [
        'id' => 'id',
        'Account_id' => 'owned',
        'Name' => 'named'
    ];

    protected $tableFields = ['Name','Image','About'];


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
                'creationDate' => $Grp->creationDate,
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
                    //'href' => $this->getAccountRoute($groupOwner),
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
                        //'href' => $this->getAccountRoute($Admin),
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
            if(in_array('pendingMembers',$withKeys)){
                $Members = $Grp->pendingMembers;
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

            if(in_array('haveSuperGroup',$withKeys)){
                $entry['super'] =  $Grp->haveSuperGroup;
            }

            if(in_array('haveSubGroup',$withKeys)){
                $SubGrps = $Grp->haveSubGroup;
                $SubGrpsList = [];
                foreach ($SubGrps as $subGrp) {
                    $SubGrpsList [] = $subGrp;
                }
                $entry['subs'] =  $SubGrpsList;
            }


            if(in_array('contain',$withKeys)){
                $Posts = $Grp->contain;
                $PostsList = [];
                foreach ($Posts as $post) {
                    $Account = $post->postedBy;
                    $Polls = $post->containedPolls;
                    $PollsList = [];
                    foreach ($Polls as $poll) {
                        $PollsList[] = $poll;
                    }
                    $Comments = $post->containedComments;
                    foreach ($Comments as $comment){
                        $comment->Publisher = $Account->firstName.' '.$Account->lastName;
                        $comment->Reactions = \DB::table('account_comment')->where("Comment_id",$comment->id)->get();
                    }
                    $reactions= \DB::table('account_post')->where("Post_id",$post->id)->get();
                    $aPost = [
                        'id'=>$post->id,
                        'Content'=>$post->content,
                        'Image'=>$post->Image,
                        'File'=>$post->File,
                        'Type'=>$post->Type,
                        'postingDate'=>$post->postingDate,
                        'popularity' =>$post->popularity,
                        'group' =>$post->containingGrp,
                        'poster'=>$Account,
                        'polls' => $PollsList,
                        'comments'=> $Comments,
                        'reactions'=>$reactions,
                    ];
                    $PostsList[] = $aPost;
                }
                $entry['posts'] = $PostsList;
            }


            $data[] = $entry;
        }
        return $data;
    }

    public function createGroup($req){
        $Grp = new Grp();
        $Grp->Name = $req->input('Name');
        //$Grp->creationDate = $req->input('creationDate');
        $Grp->creationDate = Carbon::now();
        $Grp->Image = $req->input('Image');
        $Grp->About = $req->input('About');
        $Grp->Account_id = $req->input('Account_id');
        $Grp->Grp_id = $req->input('Grp_id');
        $Grp->save();
        return $Grp;
    }

    public function updateGroup($req,$id){
        $Grp = Grp::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $Grp->fill([$field => $req[$field]]);
            }
        }
        $Grp->save();
        return $Grp;
    }
    public function deleteGroup($id){
        Grp::find($id)->delete();
    }
    public function searchGroups($search){
        $data = [];
        $accounts =  Grp::where(function ($query) use($search) {
            $query->where('Name', 'like', $search."%");
        })->take(30)->get();
        foreach ($accounts as $account){
            $data[] = $account;
        }
        return $data;
    }
}