<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewOwn(): UserResource
    {
        return new UserResource(Auth::user()->load('cities'));
    }
}
