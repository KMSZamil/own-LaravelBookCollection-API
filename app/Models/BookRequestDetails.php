<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequestDetails extends Model
{
    use HasFactory;

    public $guarded = [];

    public function book_details()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
