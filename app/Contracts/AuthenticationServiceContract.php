<?php
namespace App\Contracts;

interface AuthenticationServiceContract
{
    public function authenticate(array $credentials);
}
