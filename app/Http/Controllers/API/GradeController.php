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
        $validator = validator($request->all(), [
            'student_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'grade' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $grade = Grade::create([
            'student_id' => $request->student_id,
            'exam_id' => $request->exam_id,
            'grade' => $request->grade,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'grade stored successfully',
        ], 201);
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
    public function update(Request $request, $id)
    {
    $grades = Grade::find($id);
    if ($grades) {
        if ($request->has('student_id')) {
            $request->validate([
                'student_id' => 'required|exists:users,id',
            ]);
            $grades->student_id = $request->student_id;
        }
        if ($request->has('exam_id')) {
            $request->validate([
                'exam_id' => 'required|exists:exams,id',
            ]);
            $grades->exam_id = $request->exam_id;
        }
        if ($request->has('grade')) {
            $request->validate([
                'grade' => 'required|string',
            ]);
            $grades->grade = $request->grade;
        }
        $grades->save();

        return response()->json([
            'status' => 'success',
            'message' => 'student grade updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no grade with this id",
        ], 422);
    }
}
    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        Grade::findOrFail($id)->delete();
        return response()->json(['message' => 'Grade deleted successfully.']);
    }

}

