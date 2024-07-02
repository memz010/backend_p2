<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Addition as AdditionResource;


class AdditionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('admin')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Addition = AdditionResource::collection(Addition::paginate($limit));
        return $Addition->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'student_id' => 'required|integer',
            'information_request' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Addition::create([
            'school_id' => $request->school_id,
            'student_id' => $request->student_id,
            'information_request' => $request->information_request,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'users stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $addition = new AdditionResource( Addition::findOrFail($id));
        return $addition->response()->setStatusCode(200,"addition Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $addition = Addition::find($id);
    if ($addition) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $addition->school_id = $request->school_id;
        }
        if ($request->has('student_id')) {
            $request->validate([
                'student_id' => 'required|exists:users,id',
            ]);
            $addition->student_id = $request->student_id;
        }
        if ($request->has('information_request')) {
            $request->validate([
                'information_request' => 'required|string',
            ]);
            $addition->information_request = $request->information_request;
        }
        $addition->save();

        return response()->json([
            'status' => 'success',
            'message' => 'student addition updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no student addition with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
     if ($request->user()->role !== 4) {
         return response()->json(['message' => 'Forbidden'], 403);
     }
        Addition::findOrFail($id)->delete();
        return response()->json([
            "delete succecfully"
        ]);
    }
}
