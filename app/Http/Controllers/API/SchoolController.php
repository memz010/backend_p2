<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\School as SchoolResource;

class SchoolController
{

    public function searchSchools(Request $request)
    {
        $query = $request->input('query');
        $schools = School::where('name', 'like', "%{$query}%")->get();
        
        return response()->json([
            "status" => "success",
            "schools" => $schools->toArray()
        ]);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $school = SchoolResource::collection(School::paginate($limit));
        return $school->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'age_stage' => 'required|string',
            'Subscription_price' => 'required|integer',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        School::create([
            'name' => $request->name,
            'type' => $request->type,
            'age_stage' => $request->age_stage,
            'Subscription_price' => $request->Subscription_price,
            'address' => $request->address,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'schools stored successfully'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $school = new SchoolResource( School::findOrFail($id));
        return $school->response()->setStatusCode(200,"school Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $school->name = $request->name;
        }

        if ($request->has('type')) {
            $request->validate([
                'type' => 'required|string',
            ]);
            $school->type = $request->type;
        }

        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $school->description = $request->description;
        }

        if ($request->has('address')) {
            $request->validate([
                'address' => 'required|string',
            ]);
            $school->address = $request->address;
        }

        if ($request->has('Subscription_price')) {
            $request->validate([
                'Subscription_price' => 'required|numeric',
            ]);
            $school->Subscription_price = $request->Subscription_price;
        }

        $school->save();

        return response()->json([
            'status' => 'success',
            'message' => 'School updated successfully',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
       {
            $school = School::findOrFail($id);
            // Delete all certificates associated with the user
            $school->certificates()->delete();

            // Then delete the user
            $school->delete();

            return "school deleted Successfully";
        }
    }

