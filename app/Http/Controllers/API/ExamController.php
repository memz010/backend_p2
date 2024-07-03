<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Exam as ExamResource;

class ExamController
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Exam = ExamResource::collection(Exam::paginate($limit));
        return $Exam->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'exam_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Exam::create([
            'school_id' => $request->school_id,
            'exam_date' => $request->exam_date,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'exam stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exam = new ExamResource( Exam::findOrFail($id));
        return $exam->response()->setStatusCode(200,"Exam Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $exam = Exam::find($id);
    if ($exam) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $exam->school_id = $request->school_id;
        }
        if ($request->has('exam_date')) {
            $request->validate([
                'exam_date' => 'required|date',
            ]);
            $exam->exam_date = $request->exam_date;
        }
        $exam->save();

        return response()->json([
            'status' => 'success',
            'message' => 'student exam updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no student exam with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Exam::findOrFail($id)->delete();
        return response()->json(['message' => 'exam deleted successfully.']);
    }
}
