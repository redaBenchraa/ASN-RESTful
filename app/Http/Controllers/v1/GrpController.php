<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\GrpsServices;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Grp;

class GrpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $Grps;
    public function  __construct(GrpsServices $service)
    {
        $this->Grps = $service;
    }
    public function index()
    {
        $params = request()->input();
        $data = $this->Grps->getGrps($params);
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
            $Grp = $this->Grps->createGroup($request);
            return response()->json($Grp,201);
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
        $data = $this->Grps->getGrps($params);
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
            $Grp = $this->Grps->updateGroup($request,$id);
            return response()->json($Grp,200);
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
            $Grp = $this->Grps->deleteGroup($id);
            return response()->json('',204);
        }catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch(Exception $e){
            return  response()->json(['error'=>$e->getMessage()],500);
        }
    }

    public function addAdmin(Request $req,$id){
        $group = Grp::find($id);
        $adminId = $req->input('adminId');
        $group->administratedBy()->attach($adminId);

    }

    public function removeAdmin(Request $req,$id){
        $group = Grp::find($id);
        $adminId = $req->input('adminId');
        $group->administratedBy()->detach($adminId);

    }

    public function addMember(Request $req,$id){
        $group = Grp::find($id);
        $memberId = $req->input('memberId');
        $group->containMembers()->attach($memberId,['Accepted'=>0]);
    }
    public function updateMember(Request $req,$id){
        $group = Grp::find($id);
        $memberId = $req->input('memberId');
        $accepted = $req->input('Accepted');
        $group->containMembers()->updateExistingPivot($memberId, ['Accepted'=>$accepted]);
    }
    public function removeMember(Request $req,$id){
        $group = Grp::find($id);
        $memberId = $req->input('memberId');
        $group->containMembers()->detach($memberId);
    }
    public function searchGroups($search){
        $data = $this->Grps->searchGroups($search);
        return response()->json($data);
    }
}
