<?php

namespace App\Http\Controllers\API;

use App\Models\Guardian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Guardian as GuardianResource;

class GuardianController
{
    /**
     * Display a listing of the resource.
     */

    /*public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('admin')->except(['index','show']);
    }*/
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Guardian = GuardianResource::collection(Guardian::paginate($limit));
        return $Guardian->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'student_id' => 'required|integer',
            'guardian_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Guardian::create([
            'student_id' => $request->student_id,
            'guardian_id' => $request->guardian_id,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Guardian stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Guardian = new GuardianResource( Guardian::findOrFail($id));
        return $Guardian->response()->setStatusCode(200,"Guardian Returned Succfully")
        ->header('Guardian Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
