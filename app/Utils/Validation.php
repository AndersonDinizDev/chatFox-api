<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class Validation
{
    public static function validateEmail($email)
    {
        return Validator::make(['email' => $email], [
            'email' => 'required|email|min:8'
        ]);
    }

    public static function validatePassword($password)
    {
        return Validator::make(['password' => $password], [
            'password' => 'required|min:8'
        ]);
    }
}
