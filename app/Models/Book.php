<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $guarded = [];

    public function book_request_details()
    {
        return $this->hasMany(BookRequestDetails::class, 'book_request_id', 'id');
    }
}
