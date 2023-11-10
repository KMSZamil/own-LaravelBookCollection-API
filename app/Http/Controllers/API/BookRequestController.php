<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use App\Models\BookRequestDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookRequestResource;
use App\Http\Resources\BookRequestCollection;

class BookRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $request->validate([
            'data.user_id' => 'required',
            'data.books.*.book_id' => 'required|exists:books,id'
        ]);


        $books = $request->data['books'];
        $user_id = $request->data['user_id'];

        $user_type = User::where('id', $user_id)->first()->user_type;

        if ($user_type == 1) {

            DB::beginTransaction();

            try {
                $book_request = BookRequest::create([
                    'book_requested_by' => $user_id,
                    'created_by' => $user_id,
                ]);

                foreach ($books as $key => $value) {
                    BookRequestDetails::create([
                        'book_request_id' => $book_request->id,
                        'book_id' => $value['book_id']
                    ]);
                }

                DB::commit();

                return response()->json([
                    'message' => 'Book Collection Request Created Successfully and Waiting for Approva!',
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'message' => 'Something went wrong!',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User Must be a Student to Book Collection Request!'
            ]);
        }
    }

    public function students_book_not_approved_list(Request $request)
    {
        $user_id = $request->user_id;
        return new BookRequestCollection(
            BookRequest::where('book_requested_by', $user_id)
                ->where('approval', 'N')
                ->get()
        );
    }

    public function students_book_approved_list(Request $request)
    {
        $user_id = $request->user_id;
        return new BookRequestCollection(
            BookRequest::where('book_requested_by', $user_id)
                ->where('approval', 'Y')
                ->get()
        );
    }

    public function students_book_request_pending_list(Request $request)
    {
        $user_id = $request->user_id;
        return new BookRequestCollection(
            BookRequest::where('book_requested_by', $user_id)
                ->where('approval', NULL)
                ->get()
        );
    }

    public function pending_book_request_list(Request $request)
    {
        return new BookRequestCollection(
            BookRequest::where('approval', NULL)
                ->get()
        );
    }

    public function make_approval(Request $request)
    {
        $request->validate([
            'book_request_id' => 'required|exists:book_requests,id',
            'approval' => 'required',
            'approved_by' => 'required|exists:users,id',
        ]);

        $book_request_id = $request->book_request_id;
        $approval = $request->approval;
        $approved_by = $request->approved_by;

        $user_type = User::where('id', $approved_by)->first()->user_type;

        if ($user_type == 1) {
            $book_request = BookRequest::find($book_request_id);
            $book_request->approval = $approval;
            $book_request->approved_by = $approved_by;
            $book_request->approved_date = now();
            $book_request->save();

            return response()->json([
                'message' => 'Book request approval complete!',
            ]);
        } else {
            return response()->json([
                'message' => 'User Must be a Librarian to Book Request Approval!'
            ]);
        }
    }

    public function librarian_approved_book_request_list(Request $request)
    {
        $user_id = $request->user_id;
        return new BookRequestCollection(
            BookRequest::where('approval', 'Y')
                ->where('approved_by', $user_id)
                ->get()
        );
    }

    public function book_request_details(Request $request)
    {
        $book_request_id = $request->book_request_id;
        return new BookRequestResource(
            BookRequest::where('id',$book_request_id)
            ->first()
        );
    }
}
