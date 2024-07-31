<?php

namespace App\Http\Controllers\API;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Resources\Subject as SubjectResource;
use Illuminate\Support\facades\Hash;

class SubjectController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Subject = SubjectResource::collection(Subject::paginate($limit));
        return $Subject->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'id_stage' => 'required|integer',
            'name' => 'required|string',
            'semester' => 'required|integer|min:1|max:2',
            'lectuer_per_week' => 'required|integer',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Subject::create([
            'id_stage' => $request->id_stage,
            'name' => $request->name,
            'semester' => $request->semester,
            'lectuer_per_week' => $request->lectuer_per_week,
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
        $Subject = new SubjectResource( Subject::findOrFail($id));
        return  $Subject->response()->setStatusCode(200,"Subject Returned Succfully")
        ->header('Subject Header','True') ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Subject = Subject::find($id);
    if ( $Subject) {
        if ($request->has('id_stage')) {
            $request->validate([
                'id_stage' => 'required|exists:schools,id',
            ]);
            $Subject->id_stage = $request->id_stage;
        }

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $Subject->name = $request->name;
        }
        if ($request->has('semester')) {
            $request->validate([
                'semester' => 'required|integer|min:1|max:2',
            ]);
            $Subject->semester = $request->semester;
        }
        if ($request->has('lectuer_per_week')) {
            $request->validate([
                'lectuer_per_week' => 'required|integer',
            ]);
            $Subject->lectuer_per_week = $request->lectuer_per_week;
        }
        $Subject->save();

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
        Subject::findOrFail($id)->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
