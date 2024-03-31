<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServices
{
    public function generateToken($credentials)
    {
        return JWTAuth::attempt($credentials);
    }
}
