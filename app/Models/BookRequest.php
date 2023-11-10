<?php

namespace App\Models;

use App\Models\BookRequestDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookRequest extends Model
{
    use HasFactory;

    public $guarded = [];

    public function book_request_details()
    {
        return $this->hasMany(BookRequestDetails::class, 'book_request_id', 'id');
    }

    public function book_requested_by_details()
    {
        return $this->belongsTo(User::class, 'book_requested_by', 'id');
    }

    public function approved_by_details()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
