<?php

namespace App\Http\Controllers\API;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Submission as SubmissionResource;

class SubmissionController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Submission = SubmissionResource::collection(Submission::paginate($limit));
        return $Submission->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'task_id' => 'required|integer',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Submission::create([
            'task_id' => $request->task_id,
            'description' => $request->description,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'report stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Submission = new SubmissionResource( Submission::findOrFail($id));
        return  $Submission->response()->setStatusCode(200,"Submission Returned Succfully")
        ->header('Submission Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Submission = Submission::find($id);
    if ( $Submission) {
        if ($request->has('task_id')) {
            $request->validate([
                'task_id' => 'required|exists:tasks,id',
            ]);
            $Submission->task_id = $request->task_id;
        }
        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $Submission->description = $request->description;
        }
        $Submission->save();

        return response()->json([
            'status' => 'success',
            'message' => 'repot updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no report with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Submission::findOrFail($id)->delete();

        return response()->json(['message' => 'Submission deleted successfully.']);
    }
}
