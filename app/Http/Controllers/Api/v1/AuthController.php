<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\AuthenticationManager;
use App\Models\User;
use App\Http\Resources\UserResource;


class AuthController extends Controller
{
    protected $authenticationManager;

    public function __construct(AuthenticationManager $authenticationManager)
    {
        $this->authenticationManager = $authenticationManager;
    }

    public function auth(Request $request)
    {
        // validate requests with form requests
        $credentials = $request->only('email', 'password');
        $user = $this->authenticationManager->authenticate($credentials, $request->type);
        if (isset($user['error'])) 
            return response()->json($user, 401);
        return response()->json([
            'data' => new UserResource($user),
            'token' => $user->createToken('LaravelSanctumAuth')->plainTextToken,
            'status'=>'success'
        ]);
    }

}
