<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserTypeCollection;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getType()
    {
        return new UserTypeCollection(UserType::all());
    }
}
