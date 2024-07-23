<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Book as BookResource;

class BookController
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
        $Book = BookResource::collection(Book::paginate($limit));
        return $Book->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'subject_id' => 'required|integer',
            'book_id' => 'required|integer',
            'assosiation_level' => 'required|integer|min:1|max:12',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        Book::create([
            'subject_id' => $request->subject_id,
            'book_id' => $request->book_id,
            'assosiation_level' => $request->assosiation_level,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Book stored successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = new BookResource( Book::findOrFail($id));
        return $book->response()->setStatusCode(200,"book Returned Succfully")
        ->header('book Header','True') ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $book = Book::find($id);
    if ($book) {
        if ($request->has('subject_id')) {
            $request->validate([
                'subject_id' => 'required|exists:subjects,id',
            ]);
            $book->subject_id = $request->subject_id;
        }
        if ($request->has('book_id')) {
            $request->validate([
                'book_id' => 'required|exists:books,id',
            ]);
            $book->book_id = $request->book_id;
        }
        if ($request->has('assosiation_level')) {
            $request->validate([
                'assosiation_level' => 'required|integer|min:1|max:12',
            ]);
            $book->assosiation_level = $request->assosiation_level;
        }
        $book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'book updated successfully',
        ], 201);
    } else {
        return response()->json([
            "status" => "error",
            "message" => "There is no book with this id",
        ], 422);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return response()->json(['message' => 'Book deleted successfully.']);
    }
}
