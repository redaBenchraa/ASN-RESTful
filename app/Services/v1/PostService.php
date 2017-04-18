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
        'reactingAccounts' => 'reactions'

    ];
    protected $clauseProprieties = [
        'id' => 'id',
        'Type' => 'type',
        'postingDate' => 'date',
        'popularity' => 'votes',
        'account_id' => 'account',
        'group_id' => 'group',
    ];
    protected $tableFields  = ['popularity'];

    public function getPosts($params){
        $withKeys = [];
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
            if(in_array('reactingAccounts',$withKeys)){
                $reactedAccounts = $Post->reactingAccounts;
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

    public function createPost($req){
        $post = new Post();
        $post->Content = $req->input('Content');
        $post->Image = $req->input('Image');
        $post->File = $req->input('File');
        $post->Type = $req->input('Type');
        $post->postingDate = $req->input('postingDate');
        $post->popularity = 0;
        $post->Account_id = $req->input('Account_id');
        $post->Grp_id = $req->input('Grp_id');
        $post->save();
        return $post;
    }
    public function updatePost($req,$id){
        $post = Post::find($id);
        foreach ($this->tableFields as $field){
            if(isset($req[$field])){
                $post->fill([$field => $req[$field]]);
            }
        }
        $post->save();
        return $post;
    }
    public function deletePost($id){
        Post::find($id)->delete($id);
    }
}