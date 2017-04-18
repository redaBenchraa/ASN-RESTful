<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\MessageService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Messages;
    public function  __construct(MessageService $service)
    {
        $this->Messages = $service;
    }

    public function index()
    {
        $params = request()->input();
        $data = $this->Messages->getMessages($params);
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
            $message = $this->Messages->createMessage($request);
            return response()->json($message,201);
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
        $data = $this->Messages->getMessages($params);
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
            $message = $this->Messages->updateMessage($request,$id);
            return response()->json($message,200);
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
            $message = $this->Messages->deleteMessage($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }
}
