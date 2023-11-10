<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'approval' => $this->approval,
            'approved_by' => $this->approved_by,
            'approved_date' => $this->approved_date,
            'created_by' => $this->created_by,
            'book_request_details' =>new BookRequestDetailsCollection($this->book_request_details)
        ];
    }
}
