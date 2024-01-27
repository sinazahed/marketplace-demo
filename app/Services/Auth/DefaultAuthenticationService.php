<?php
namespace App\Services\Auth;

use App\Contracts\AuthenticationServiceContract;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DefaultAuthenticationService implements AuthenticationServiceContract
{
    public function authenticate(array $credentials)
    {
        if(Auth::attempt($credentials)){
            return Auth::user();
        }
        return ['error' => 'Authentication failed'];
    }
}