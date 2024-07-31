<?php

namespace App\Http\Controllers\API;

use App\Models\Stage;
use Illuminate\Http\Request;
use App\Http\Resources\Stage as StageResource;
use Illuminate\Support\facades\Hash;

class StageController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Stage = StageResource::collection(Stage::paginate($limit));
        return $Stage->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'name' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Stage::create([
            'school_id' => $request->school_id,
            'name' => $request->name,

        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'stage stored successfully',
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Stage = new StageResource( Stage::findOrFail($id));
        return  $Stage->response()->setStatusCode(200,"Stage Returned Succfully")
        ->header('Stage Header','True') ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Stage = Stage::find($id);
    if ( $Stage) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $Stage->school_id = $request->school_id;
        }

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $Stage->name = $request->name;
        }
        $Stage->save();

        return response()->json([
            'status' => 'success',
            'message' => 'stage updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no stage with this id",
        ], 422);
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Stage ::findOrFail($id)->delete();

        return response()->json(['message' => 'Stage deleted successfully.']);
    }
}
