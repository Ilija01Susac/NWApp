<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Http\Resources\Branch as BranchResource;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return BranchResource::collection($branches);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = new Branch;

        $branch->ADDRESS = $request->input('ADDRESS');
        $branch->CITY = $request->input('CITY');
        $branch->NAME = $request->input('NAME');
        $branch->STATE = $request->input('STATE');
        $branch->ZIP_CODE = $request->input('ZIP_CODE');

        $branch->save();
        return new BranchResource($branch);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::where('BRANCH_ID', '=', $id)->firstOrFail();
        return new BranchResource($branch);
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
        $branch = Branch::where('BRANCH_ID', '=', $id)->firstOrFail();
        $branch->ADDRESS = $request->input('ADDRESS');
        $branch->CITY = $request->input('CITY');
        $branch->NAME = $request->input('NAME');
        $branch->STATE = $request->input('STATE');
        $branch->ZIP_CODE = $request->input('ZIP_CODE');
        $branch->save();
        return new BranchResource($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::where('BRANCH_ID', '=', $id)->firstOrFail();

        if($branch->delete()){
            return new BranchResource($branch);
        }
    }
}
