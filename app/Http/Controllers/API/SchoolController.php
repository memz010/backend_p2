<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\School as SchoolResource;

class SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $School = SchoolResource::collection(School::paginate($limit));
        return $School->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        //
    }
}
