<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookRequestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($book_request) {
                return [
                    'id' => $book_request->id,
                    'approval' => $book_request->approval,
                    'approved_by' => new UserResource($book_request->approved_by_details),
                    'approved_date' => $book_request->approved_date,
                    'created_by' => $book_request->created_by,
                    'book_request_details' =>new BookRequestDetailsCollection($book_request->book_request_details)
                ];
            })
        ];
    }
}
