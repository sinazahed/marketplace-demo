<?php

namespace App\Contracts;

interface RegisterServiceContract
{
    public function register(array $credentials);
}