<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use  App\Http\Resources\Section as SectionResource;

class SectionController
{
    /**
     * Display a listing of the resource.
     */
      /* public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('admin')->except(['index','show']);
    } */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Section = SectionResource::collection(Section::paginate($limit));
        return $Section->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'student_id' => 'required|integer',
            'stage_id' => 'required|integer',
            'count_of_student' => 'required|integer',
            'number_of_section' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Section::create([
            'student_id' => $request->student_id,
            'stage_id' => $request->stage_id,
            'count_of_student' => $request->count_of_student,
            'number_of_section' => $request->number_of_section,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'section stored successfully'
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $section = new SectionResource( Section::findOrFail($id));
        return  $section->response()->setStatusCode(200,"section Returned Succfully")
        ->header('section Header','True') ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $section = Section::find($id);
    if ( $section) {
        if ($request->has('student_id')) {
            $request->validate([
                'student_id' => 'required|exists:users,id',
            ]);
            $section->student_id = $request->student_id;
        }
        if ($request->has('stage_id')) {
            $request->validate([
                'stage_id' => 'required|exists:stages,id',
            ]);
            $section->stage_id = $request->stage_id;
        }
        if ($request->has('count_of_student')) {
            $request->validate([
                'count_of_student' => 'required|integer',
            ]);
            $section->count_of_student = $request->count_of_student;
        }
        if ($request->has('number_of_section')) {
            $request->validate([
                'number_of_section' => 'required|integer',
            ]);
            $section->number_of_section = $request->number_of_section;
        }
        $section->save();

        return response()->json([
            'status' => 'success',
            'message' => 'section updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no section with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Section::findOrFail($id)->delete();
        return response()->json(['message' => 'section deleted successfully.']);
    }
}
