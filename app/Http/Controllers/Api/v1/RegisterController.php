<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRegister;

class RegisterController extends Controller
{
    public function create(Request $request, UserRegister $UserRegister)
    {
        // Also validate for unique email

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return new UserResource($user);
    }
}
