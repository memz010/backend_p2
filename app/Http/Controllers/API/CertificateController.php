<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Certificate as CertificateResource;
use Illuminate\Support\facades\Hash;

class CertificateController
{
    public function __construct()
    {
      //  $this->middleware('auth:api')->except(['index','show']);
       // $this->middleware('admin')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Certificate = CertificateResource::collection(Certificate::paginate($limit));
        return $Certificate->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'user_id' => 'required|integer',
            'school_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $pdfpath = null;
        if ($request->hasFile('file')) {
            $pdfpath = $request->file('file')->store('files');
        }

        $certificate = Certificate::create([
            'user_id' => $request->user_id,
            'school_id' => $request->school_id,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $pdfpath ,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Certificate stored successfully',
            'certificate' => $certificate,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $certificate = new CertificateResource( Certificate::findOrFail($id));
        return $certificate->response()->setStatusCode(200,"Certificate Returned Succfully")
        ->header('Additional Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $certificate = Certificate::find($id);
    if ($certificate) {
        if ($request->has('user_id')) {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
            $certificate->user_id = $request->user_id;
        }

        if ($request->has('school_id')) {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
            ]);
            $certificate->school_id = $request->school_id;
        }

        if ($request->has('title')) {
            $request->validate([
                'title' => 'required|string',
            ]);
            $certificate->title = $request->title;
        }

        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $certificate->description = $request->description;
        }

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|file|mimes:pdf',
            ]);
            $pdfpath = $request->file('pdf')->store('pdfs');
            $certificate->pdf = $pdfpath;
        }
            $certificate->save();
            return response()->json([
                'status' => 'success',
                'message' => 'certificate updated successfully',
            ], 201);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "There is no certificate with this ID",
            ], 422);
    }
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    $certificate = Certificate::findOrFail($id);

    // Check if the authenticated user is an admin
    $certificate->delete();
    return response()->json(['message' => 'Certificate deleted successfully.']);
}
}
