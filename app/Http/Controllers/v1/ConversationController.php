<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\ConversationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Conversation;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Conversations;
    public function  __construct(ConversationService $service)
    {
        $this->Conversations = $service;
    }
    public function index()
    {
        $params = request()->input();
        $data = $this->Conversations->getConversations($params);
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
            $conversation = $this->Conversations->createConversation($request);
            return response()->json($conversation,201);
        }catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
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
        $data = $this->Conversations->getConversations($params);
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
            $conversation = $this->Conversations->updateConversation($request,$id);
            return response()->json($conversation,200);
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
            $conversation = $this->Conversations->deleteComment($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function addAccount(Request $req,$id){
        $conversation = Conversation::find($id);
        $accountId = $req->input('accountId');
        $conversation->containAccount()->attach($accountId);
    }
    public function removeAccount(Request $req,$id){
        $conversation = Conversation::find($id);
        $accountId = $req->input('accountId');
        $conversation->containAccount()->detach($accountId);
    }
}
