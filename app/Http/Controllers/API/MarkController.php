<?php

namespace App\Http\Controllers\API;

use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use  App\Http\Resources\Mark as MarkResource;

class MarkController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Mark = MarkResource::collection(Mark::paginate($limit));
        return $Mark->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'student_id' => 'required|integer',
            'submission_id' => 'required|integer',
            'note' => 'required|string',
            'mark' => 'required|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $Mark = Mark::create([
            'student_id' => $request->student_id,
            'submission_id' => $request->submission_id,
            'note' => $request->note,
            'mark' => $request->mark,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'mark stored successfully',
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Mark = new MarkResource( Mark::findOrFail($id));
        return $Mark->response()->setStatusCode(200,"Mark Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $Mark = Mark::find($id);
    if ($Mark) {
        if ($request->has('student_id')) {
            $request->validate([
                'student_id' => 'required|exists:users,id',
            ]);
            $Mark->student_id = $request->student_id;
        }
        if ($request->has('submission_id')) {
            $request->validate([
                'submission_id' => 'required|exists:submissions,id',
            ]);
            $Mark->submission_id = $request->submission_id;
        }
        if ($request->has('note')) {
            $request->validate([
                'note' => 'required|string',
            ]);
            $Mark->note = $request->note;
        }
        if ($request->has('mark')) {
            $request->validate([
                'mark' => 'required|integer|min:1|max:100',
            ]);
            $Mark->mark = $request->mark;
        }
        $Mark->save();

        return response()->json([
            'status' => 'success',
            'message' => 'student mark updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no mark with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Mark::findOrFail($id)->delete();
        return response()->json(['message' => 'Mark deleted successfully.']);
    }
}
