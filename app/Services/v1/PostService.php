<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 17:01
 */

namespace App\Services\v1;


use App\Post;

class PostService  extends serviceBP {
    protected $supportedFields = [
        'containedComments' => 'comments',
        'containedPolls' => 'polls',
        'containingGrp' => 'group',
        'postedBy' => 'account',

    ];
    protected $clauseProprieties = [
        'id' => 'id',
        'Type' => 'type',
        'postingDate' => 'date',
        'popularity' => 'votes',
        'account_id' => 'account',
        'group_id' => 'group',
    ];

    public function getPosts($params){
        $withKeys = [];
        $whereClauses = [];
        if(empty($params)){
            return $this->filterPosts(Post::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Posts = Post::with($withKeys)->where($whereClauses)->get();
        return $this->filterPosts($Posts,$withKeys);

    }
    public function filterPosts($Posts,$withKeys){
        $data = [];
        foreach ($Posts as $Post){
            $entry = [
                'id' => $Post->id,
                'content' => $Post->content,
                'File' => $Post->File,
                'Image' => $Post->Image,
                'Type' => $Post->Type,
                'postingDate' => $Post->postingDate,
                'popularity' => $Post->popularity,
                'Account' => $Post->Account_id,
                'Group' => $Post->Group_id,
                'href' => route('Posts.show',['id'=>$Post->id]),
            ];
            if(in_array('postedBy',$withKeys)){
                $Account = $Post->postedBy;
                $entry['account'] = [
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
            if(in_array('containingGrp',$withKeys)){
                $Group= $Post->containingGrp;
                $entry['group'] = [
                    'id' => $Group->id,
                    'Name' => $Group->Name,
                    'Image' => $Group->Image,
                    'About' => $Group->About,
                ];
            }
            if(in_array('containedComments',$withKeys)){
                $Comments= $Post->containedComments;
                $commentsList = [];
                foreach ($Comments as $Comment) {
                    $commentItem = [
                        'id' => $Comment->id,
                        'Content' => $Comment->Content,
                        'Popularity' => $Comment->Popularity,
                        'File' => $Comment->File,
                        'Type' => $Comment->Type,
                        'Date' => $Comment->created_at,
                        'Account' => $Comment->Account_id,
                    ];
                    $commentsList[] = $commentItem;
                }
                $entry['comments'] = $commentsList;
            }
            if(in_array('containedPolls',$withKeys)){
                $Polls= $Post->containedPolls;
                $pollList = [];
                foreach ($Polls as $Poll) {
                    $pollItem = [
                        'id' => $Poll->id,
                        'Content' => $Poll->Content,
                        'Vote' => $Poll->Vote,
                        ];
                        $pollList[] = $pollItem;
                }
                $entry['polls'] = $pollList;
            }
            $data[] = $entry;
        }
        return $data;
    }
}