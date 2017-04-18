<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\PollService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Poll;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Polls;
    public function  __construct(Pollservice $service)
    {
        $this->Polls = $service;
    }
    public function index()
    {
        $params = request()->input();
        $data = $this->Polls->getPolls($params);
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
            $poll = $this->Polls->createPoll($request);
            return response()->json($poll,201);
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
        $data = $this->Polls->getPolls($params);
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
            $poll = $this->Polls->updatePoll($request,$id);
            return response()->json($poll,200);
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
            $poll = $this->Polls->deletePoll($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function addVoter(Request $request,$id){
        $poll = Poll::find($id);
        $accountId = $request->input('accountId');
        $poll->voters()->attach($accountId);
    }
    public function removeVoter(Request $request,$id){
        $poll = Poll::find($id);
        $accountId = $request->input('accountId');
        $poll->voters()->detach($accountId);
    }
}
