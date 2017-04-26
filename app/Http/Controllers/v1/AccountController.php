<?php

namespace App\Http\Controllers\v1;
use App\Services\v1\AccountsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Account;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Accounts;
    public function  __construct(AccountsService $service)
    {
        $this->Accounts = $service;
    }

    public function index()
    {
        $params = request()->input();
        $data = $this->Accounts->getAccounts($params);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $Account = $this->Accounts->createAccount($request);
            return response()->json($Account,201);
        }catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $params = request()->input();
        $params['id'] = $id;
        $data = $this->Accounts->getAccounts($params);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $account = $this->Accounts->updateAccount($request,$id);
            return response()->json($account,200);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $account = $this->Accounts->deleteAccount($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function checkAccount(Request $request){
        $email = $request->input('Email');
        $password = $request->input('password');
        try{
            $account = Account::where([['Email','=',$email],['password','=',$password]])->firstOrFail();
            return response()->json($account,200);
        }catch(ModelNotFoundException  $e){
            return  response()->json(['error'=>$e->getMessage()],404);;
        }
    }
    public function addConversation(Request $req,$id){
        $account = Account::find($id);
        $conversationId = $req->input('conversationId');
        $account->participateInConversation()->attach($conversationId);
    }
    public function removeConversation(Request $req,$id){
        $account = Account::find($id);
        $conversationId = $req->input('conversationId');
        $account->participateInConversation()->detach($conversationId);
    }
    public function addPollVote(Request $req,$id){
        $account = Account::find($id);
        $pollId= $req->input('pollId');
        $account->voteInPoll()->attach($pollId);
    }
    public function removePollVote(Request $req,$id){
        $account = Account::find($id);
        $pollId= $req->input('pollId');
        $account->voteInPoll()->detach($pollId);
    }
    public function addReactInComment(Request $req,$id){
        $account = Account::find($id);
        $commentId= $req->input('commentId');
        $Type = $req->input('type');
        $account->reactInComment()->attach($commentId,['Type'=>$Type]);
    }
    public function removeReactInComment(Request $req,$id){
        $account = Account::find($id);
        $commentId= $req->input('commentId');
        $account->reactInComment()->detach($commentId);
    }
    public function addReactInPost(Request $req,$id){
        $account = Account::find($id);
        $postId= $req->input('postId');
        $Type = $req->input('type');
        $account->reactsInPost()->attach($postId,['Type'=>$Type]);
    }
    public function removeReactInPost(Request $req,$id){
        $account = Account::find($id);
        $postId= $req->input('postId');
        $account->reactsInPost()->detach($postId);
    }
    public function becomeAdmin(Request $req,$id){
        $account = Account::find($id);
        $groupId= $req->input('groupId');
        $account->administrate()->attach($groupId);
    }
    public function removeAdmin(Request $req,$id){
        $account = Account::find($id);
        $groupId= $req->input('groupId');
        $account->administrate()->detach($groupId);
    }
    public function becomeMember(Request $req,$id){
        $account = Account::find($id);
        $groupId= $req->input('groupId');
        $account->belongsToGroup()->attach($groupId);
    }
    public function removeMember(Request $req,$id){
        $account = Account::find($id);
        $groupId= $req->input('groupId');
        $account->belongsToGroup()->detach($groupId);
    }
    public function searchMembers($search){
        $data = $this->Accounts->searchMembers($search);
        return response()->json($data);
    }



}
