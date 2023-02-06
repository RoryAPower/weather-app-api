<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewOwnUser(): UserResource
    {
        $user = Auth::user();

        return new UserResource($user->load('cities'));
    }
}
