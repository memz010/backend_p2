<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use  App\Http\Resources\User as UserResource;
use Illuminate\Support\facades\Hash;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;
    $users = User::where('role', 1)
              ->paginate($limit);
    $userResource = UserResource::collection($users);
    return $userResource->response()->setStatusCode(200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'role' => 'required|integer|min:1|max:4',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'birth_day' => 'required|date',
            'gender' => 'required|boolean',
            'nationality' => 'required|string',
            'phone' => 'required|string',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $imagePath = null;
        $imagepath = $request->file('image')->store('images');
        User::create([
            'school_id' => $request->school_id,
            'role' => $request->role,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
            'birth_day' => $request->birth_day,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'image' => $request->imagepath,
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
    $user = User::findOrFail($id);
    if ($user->role !== 1) {
        return response()->json([
            'message' => 'There is no student with this ID'
           ], 403);
    }

    $userResource = new UserResource($user);
    return $userResource->response()
        ->setStatusCode(200, "User has been successfully accessed")
        ->header('Additional Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $user = User::find($id);
    if ($user) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $user->school_id = $request->school_id;
        }

        if ($request->has('role')) {
            $request->validate([
                'role' => 'required|integer|min:1|max:4',
            ]);
            $user->role = $request->role;
        }

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $user->name = $request->name;
        }

        if ($request->has('last_name')) {
            $request->validate([
                'last_name' => 'required|string',
            ]);
            $user->last_name = $request->last_name;
        }

        if ($request->has('father_name')) {
            $request->validate([
                'father_name' => 'required|string',
            ]);
            $user->father_name = $request->father_name;
        }

        if ($request->has('email')) {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|string|min:8',
            ]);
            $user->password = bcrypt($request->password);
        }

        if ($request->has('birth_day')) {
            $request->validate([
                'birth_day' => 'required|date',
            ]);
            $user->birth_day = $request->birth_day;
        }

        if ($request->has('gender')) {
            $request->validate([
                'gender' => 'required|boolean',
            ]);
            $user->gender = $request->gender;
        }

        if ($request->has('nationality')) {
            $request->validate([
                'nationality' => 'required|string',
            ]);
            $user->nationality = $request->nationality;
        }

        if ($request->has('phone')) {
            $request->validate([
                'phone' => 'required|string',
            ]);
            $user->phone = $request->phone;
        }

        if ($request->has('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imagePath = $request->file('image')->store('images');
            $user->image = $imagePath;
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no user with this ID",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete all certificates associated with the user
        $user->certificates()->delete();

        // Then delete the user
        $user->delete();
        return response()->json([
            "delete succecfully"
        ]);
    }
}
