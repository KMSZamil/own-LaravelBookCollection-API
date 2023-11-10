<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserTypeController;
use App\Http\Controllers\API\BookRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::get('get_user_type', [UserTypeController::class, 'getType']);

Route::apiResource('books', BookController::class);
Route::post('/books/update', [BookController::class, 'update']);

Route::post('/books_request/store', [BookRequestController::class, 'store']);

Route::get('/books_request/students_book_not_approved_list', [BookRequestController::class, 'students_book_not_approved_list']);
Route::get('/books_request/students_book_approved_list', [BookRequestController::class, 'students_book_approved_list']);

Route::get('/books_request/pending_book_request_list', [BookRequestController::class, 'pending_book_request_list']);
Route::post('/books_request/make_approval', [BookRequestController::class, 'make_approval']);

Route::get('/books_request/librarian_approved_book_request_list', [BookRequestController::class, 'librarian_approved_book_request_list']);

Route::get('/books_request/book_request_details', [BookRequestController::class, 'book_request_details']);
