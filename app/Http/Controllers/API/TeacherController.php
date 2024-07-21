<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use  App\Http\Resources\Teacher as TeacherResource;
class TeacherController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:api')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;
        $users = User::where('role', 2)
                  ->paginate($limit);
        $teacherResource = TeacherResource::collection($users);
        return $teacherResource->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $user = User::findOrFail($id);
    if ($user->role !== 2) {
        return response()->json([
            'message' => 'There is no teacher with this ID'
           ], 403);
    }

    $teacherResource = new TeacherResource($user);
    return $teacherResource->response()
        ->setStatusCode(200, "User has been successfully accessed")
        ->header('Additional Header', 'True');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
