<?php

namespace App\Http\Controllers\API;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Grade as GradeResource;
use Illuminate\Support\facades\Hash;

class GradeController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $grade = GradeResource::collection(Grade::paginate($limit));
        return $grade->response()->setStatusCode(200) ;
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
    public function show($id)
    {
        $grade = new GradeResource( Grade::findOrFail($id));
        return $grade->response()->setStatusCode(200,"Grade Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
