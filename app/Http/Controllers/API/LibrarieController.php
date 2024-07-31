<?php

namespace App\Http\Controllers\API;
use App\Models\Librarie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Librarie as LibrarieResource;
class LibrarieController
{
    /**
     * Display a listing of the resource.
     */

     /*public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('admin')->except(['index','show']);
    }*/
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Librarie = LibrarieResource::collection(Librarie::paginate($limit));
        return $Librarie->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'school_id' => 'required|integer',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Librarie::create([
            'school_id' => $request->school_id,
            'description' => $request->description,
            'type' => $request->type,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Librarie stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Librarie = new LibrarieResource( Librarie::findOrFail($id));
        return $Librarie->response()->setStatusCode(200,"Librarie Returned Succfully")
        ->header('Librarie Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $Librarie = Librarie::find($id);
    if ($Librarie) {
        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $Librarie->school_id = $request->school_id;
        }
        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $Librarie->description = $request->description;
        }
        if ($request->has('type')) {
            $request->validate([
                'type' => 'required|string',
            ]);
            $Librarie->type = $request->type;
        }
        $Librarie->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Librarie updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no Librarie with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Librarie::findOrFail($id)->delete();
        return response()->json(['message' => 'Librarie deleted successfully.']);
    }
}
