<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 10/04/17
 * Time: 20:38
 */

namespace App\Services\v1;


use App\Poll;

class PollService extends serviceBP {
    protected $supportedFields = [
        'containingPost' => 'post',
        'voters' => 'voters',

    ];
    protected $clauseProprieties = [
        'id' => 'id',
        'Post_id' => 'post',
    ];

    protected $tableFields = ['Vote'];

    public function getPolls($params){
        $withKeys = [];
        $whereClauses = [];
        if(empty($params)){
            return $this->filterPolls(Poll::all(),$withKeys);
        }
        $withKeys = $this->getWithKeys($params);
        $whereClauses = $this->getWhereClauses($params);
        $Polls = Poll::with($withKeys)->where($whereClauses)->get();
        return $this->filterPolls($Polls,$withKeys);

    }
    public function filterPolls($Polls,$withKeys){
        $data = [];
        foreach ($Polls as $Poll){
            $entry = [
                'id' => $Poll->id,
                'Content' => $Poll->Content,
                'Vote' => $Poll->Vote,
                'Post' => $Poll->Post_id,
                'href' => route('Polls.show',['id'=>$Poll->id]),
            ];
            if(in_array('containingPost',$withKeys)){
                $Post = $Poll->containingPost;
                $entry['post'] = [
                    'id' => $Post->id,
                    'Content' => $Post->content,
                    'date' =>$Post->postingDate,
                    'popularity' =>$Post->popularity,
                    'File' =>$Post->File,
                    'Image' =>$Post->Image
                ];
            }
            if(in_array('voters',$withKeys)){
                $Voters= $Poll->voters;
                $voterList = [];
                foreach ($Voters as $Voter) {
                    $voterItem = [
                        'account' => $Voter->id,
                    ];
                    $voterList[] = $voterItem;
                }
                $entry['voters'] = $voterList;
            }

            $data[] = $entry;
        }
        return $data;
    }

    public function createPoll($req){
        $poll = new Poll();
        $poll->Content = $req->input('Content');
        $poll->Vote = 0;
        $poll->Post_id = $req->input('Post_id');
        $poll->save();
        return $poll;
    }

    public function updatePoll($req,$id){
        $poll = Poll::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $poll->fill([$field => $req[$field]]);
            }
        }
        $poll->save();
        return $poll;
    }
    public function deletePoll($id){
        Poll::find($id)->delete();
    }
}