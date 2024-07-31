<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Report as ReportResource;

class ReportController
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
        $Report = ReportResource::collection(Report::paginate($limit));
        return $Report->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'user_id' => 'required|integer',
            'report' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Report::create([
            'school_id' => $request->school_id,
            'user_id' => $request->user_id,
            'report' => $request->report,
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
        $Report = new ReportResource( Report::findOrFail($id));
        return  $Report->response()->setStatusCode(200,"report Returned Succfully")
        ->header('report Header','True') ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Report = Report::find($id);
    if ( $Report) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $Report->school_id = $request->school_id;
        }
        if ($request->has('user_id')) {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
            $Report->user_id = $request->user_id;
        }
        if ($request->has('report')) {
            $request->validate([
                'report' => 'required|string',
            ]);
            $Report->report = $request->report;
        }
        $Report->save();

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
        report::findOrFail($id)->delete();

        return response()->json(['message' => 'report deleted successfully.']);
    }
}
