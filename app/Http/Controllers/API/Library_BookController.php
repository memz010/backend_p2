<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Library_Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Library_Book as Library_BookResource;

class Library_BookController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <=50 ? $request->input('limit') : 15 ;
        $Library_Book = Library_BookResource::collection(Library_Book::paginate($limit));
        return $Library_Book->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'library_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'author' => 'required|string',
            'type' => 'required|string',
            'pages' => 'required|integer|min:1|max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Library_Book::create([
            'library_id' => $request->library_id,
            'name' => $request->name,
            'description' => $request->description,
            'author' => $request->author,
            'type' => $request->type,
            'pages' => $request->pages,
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
        $Library_Book = new Library_BookResource( Library_Book::findOrFail($id));
        return $Library_Book->response()->setStatusCode(200,"Library_Book Returned Succfully")
        ->header('Library_Book Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $Library_Book = Library_Book::find($id);
    if ($Library_Book) {
        if ($request->has('library_id')) {
            $request->validate([
                'library_id' => 'required|exists:libraries,id',
            ]);
            $Library_Book->library_id = $request->library_id;
        }

        if ($request->has('description')) {
            $request->validate([
                'description' => 'required|string',
            ]);
            $Library_Book->description = $request->description;
        }

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $Library_Book->name = $request->name;
        }

        if ($request->has('author')) {
            $request->validate([
                'author' => 'required|string',
            ]);
            $Library_Book->author = $request->author;
        }

        if ($request->has('type')) {
            $request->validate([
                'type' => 'required|string',
            ]);
            $Library_Book->type = $request->type;
        }

        if ($request->has('pages')) {
            $request->validate([
                'pages' => 'required|integer|min:1|max:1000' ,
            ]);
            $Library_Book->email = $request->email;
        }
        $Library_Book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'library_book updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no library_book with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Library_Book::findOrFail($id)->delete();

        return response()->json(['message' => 'Library_Book deleted successfully.']);
    }
}
