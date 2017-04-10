<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 18:44
 */

namespace App\Services\v1;


use App\Comment;

class CommentService extends serviceBP {
    protected $supportedFields = [
        'containingPost' => 'post',
        'commentedBy' => 'account',
        'reactingAccounts' => 'reactions'
    ];

    protected $clauseProprieties = [
        'id' => 'id',
        'Type' => 'type',
        'created_at' => 'date',
        'Popularity' => 'votes',
        'Account_id' => 'account',
        'Post_id' => 'post',
    ];

    public function getComments($params){
        $withKeys = [];
        $whereClauses = [];
        if(empty($params)){
            return $this->filterComments(Comment::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Comments = Comment::with($withKeys)->where($whereClauses)->get();
        return $this->filterComments($Comments,$withKeys);
    }
    public function filterComments($Comments,$withKeys){
        $data = [];
        foreach ($Comments as $Comment){
            $entry = [
                'id' => $Comment->id,
                'content' => $Comment->Content,
                'File' => $Comment->File,
                'Type' => $Comment->Type,
                'postingDate' => $Comment->created_at,
                'popularity' => $Comment->Popularity,
                'Account' => $Comment->Account_id,
                'Post' => $Comment->Post_id,
                'href' => route('Comments.show',['id'=>$Comment->id]),
            ];
            if(in_array('commentedBy',$withKeys)){
                $Account = $Comment->commentedBy;
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
            if(in_array('containingPost',$withKeys)){
                $Post= $Comment->containingPost;
                $entry['post'] = [
                    'id' => $Post->id,
                    'Content' => $Post->content,
                    'File' => $Post->File,
                    'Image' => $Post->Image,
                ];
            }
            if(in_array('reactingAccounts',$withKeys)){
                $reactedAccounts = $Comment->reactingAccounts;
                $reactedAccountList =[];
                foreach ($reactedAccounts as $reactedAccount) {
                    $reactedAccountItem = [
                        'Account_id' => $reactedAccount->id,
                        'type' => $reactedAccount->pivot->type,
                    ];
                    $reactedAccountList[] = $reactedAccountItem;
                }
                $entry['reactions'] = $reactedAccountList;
            }
            $data[] = $entry;
        }
        return $data;
    }
}