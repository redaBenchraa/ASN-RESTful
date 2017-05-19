<?php

namespace App\Http\Controllers\v1;
use App\Services\v1\PostService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Posts;
    public function  __construct(Postservice $service)
    {
        $this->Posts = $service;
    }
    public function index()
    {
        $params = request()->input();
        $data = $this->Posts->getPosts($params);
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
            $post = $this->Posts->createPost($request);
            return response()->json($post,201);
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
        $data = $this->Posts->getPosts($params);
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
            $post = $this->Posts->updatePost($request,$id);
            return response()->json($post,200);
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
            $post = $this->Posts->deletePost($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function addReactingAccount(Request $request,$id){
        $post = Post::find($id);
        $accountId = $request->input('accountId');
        $Type = $request->input('Type');
        $post->reactingAccounts()->attach($accountId,['Type'=> $Type]);
        if($Type == 2){
            $post->popularity--;
        }else{
            $post->popularity++;
        }
        $post->save();
        return response()->json($post->popularity,200);
    }
    public function removeReactingAccount(Request $request,$id){
        $post = Post::find($id);
        $accountId = $request->input('accountId');
        $post->reactingAccounts()->detach($accountId);
        $post->popularity--;
        $post->save();
        return response()->json($post->popularity,200);
    }
}
