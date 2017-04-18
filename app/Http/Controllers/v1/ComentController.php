<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\CommentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Comment;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Comments;
    public function  __construct(CommentService $service)
    {
        $this->Comments = $service;
    }
    public function index()
    {
        $params = request()->input();
        $data = $this->Comments->getComments($params);
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
            $comment = $this->Comments->createComment($request);
            return response()->json($comment,201);
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
        $data = $this->Comments->getComments($params);
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
            $comment = $this->Comments->updateComment($request,$id);
            return response()->json($comment,200);
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
        $comment = $this->Comments->deleteComment($id);
        return response()->json('',204);
    }catch (ModelNotFoundException $ex){
        throw $ex;
    }
        catch(Exception $e){
        return  response()->json(['error'=>$e->getMessage()],500);
    }
    }
    public function reactedToBy(Request $req,$id){
        $comment = Comment::find($id);
        $accountId =  $req->input('accountId');
        $Type = $req->input('type');
        $comment->reactingAccounts()->attach($accountId,['Type'=>$Type]);
    }
    public function removeReact(Request $req,$id){
        $comment = Comment::find($id);
        $accountId =  $req->input('accountId');
        $comment->reactingAccounts()->detach($accountId);
    }
}
