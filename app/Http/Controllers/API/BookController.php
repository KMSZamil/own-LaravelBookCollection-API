<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksCollection;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BooksCollection(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data.user_id' => 'required',
            'data.books.*.book_name' => 'required'
        ]);


        $books = $request->data['books'];
        $user_id = $request->data['user_id'];
        $user_type = User::where('id', $user_id)->first()->user_type;

        if ($user_type == 2) {
            foreach ($books as $key => $value) {
                Book::create([
                    'book_name' => $value['book_name'],
                    'short_details' => $value['short_details'],
                    'author' => $value['author'],
                    'created_by' => $user_id
                ]);
            }
            return response()->json([
                'message' => 'Books created successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'User Must be a Librarian to Book Create!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'data.user_id' => 'required',
                'data.books.*.id' => 'required|exists:books',
                'data.books.*.book_name' => 'required'
            ],
            [
                'data.books.*.id' => 'This bookID does not exists!',
            ]
        );


        $books = $request->data['books'];
        $user_id = $request->data['user_id'];

        $user_type = User::where('id', $user_id)->first()->user_type;

        if ($user_type == 2) {
            foreach ($books as $key => $value) {

                $book = Book::find($value['id']);
                $book->book_name = $value['book_name'];
                $book->short_details = $value['short_details'];
                $book->author = $value['author'];
                $book->updated_by = $user_id;
                $book->save();
            }
            return response()->json([
                'message' => 'Books updated successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'User Must be a Librarian to Book Update!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
