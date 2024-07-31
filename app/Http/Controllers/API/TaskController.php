<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Task as TaskResource;

class TaskController
{
    /**
     * Display a listing of the resource.
     */
     /*public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('admin')->except(['index','show']);
    }
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Task = TaskResource::collection(Task::paginate($limit));
        return $Task->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'subject_id' => 'required|integer',
            'title' => 'required|string',
            'uploaded_date' => 'required|date',
            'deadline' => 'required|date',
            'start_of_submissions_date' => 'required|date',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Task::create([
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'uploaded_date' => $request->uploaded_date,
            'deadline' => $request->deadline,
            'start_of_submissions_date' => $request->start_of_submissions_date,
            'description' => $request->description,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'task stored successfully'
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Task = new TaskResource( Task::findOrFail($id));
        return  $Task->response()->setStatusCode(200,"Task Returned Succfully")
        ->header('Task Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Task = Task::find($id);
    if ( $Task) {
        if ($request->has('subject_id')) {
            $request->validate([
                'subject_id' => 'required|exists:subjects,id',
            ]);
            $Task->subject_id = $request->subject_id;
        }
        if ($request->has('title')) {
            $request->validate([
                'title' => 'required|string',
            ]);
            $Task->title = $request->title;
        }
        if ($request->has('uploaded_date')) {
            $request->validate([
                'uploaded_date' => 'required|date',
            ]);
            $Task->uploaded_date = $request->uploaded_date;
        }
        if ($request->has('deadline')) {
            $request->validate([
                'deadline' => 'required|date',
            ]);
            $Task->deadline = $request->deadline;
        }
        if ($request->has('start_of_submissions_date')) {
            $request->validate([
                'start_of_submissions_date' => 'required|date',
            ]);
            $Task->start_of_submissions_date = $request->start_of_submissions_date;
        }
        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $Task->description = $request->description;
        }
        $Task->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no Task with this id",
        ], 422);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response()->json(['message' => 'task deleted successfully.']);
    }
}
