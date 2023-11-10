<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookRequestDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->collection->transform(function ($book_request) {
                return [
                    'book_request_id' => $book_request->book_request_id,
                    // 'book_id' => $book_request->book_id,
                    'books_detail' => new BookResource($book_request->book_details)
                ];
            })
        ];
    }
}
