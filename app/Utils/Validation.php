<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class Validation
{
    public static function validateName($name)
    {
        return Validator::make(['name' => $name], [
            'name' => 'required|string|min:3'
        ]);
    }

    public static function validateEmail($email, $unique = false)
    {
        $rules = [
            'email' => 'required|email|min:8'
        ];

        if ($unique) {
            $rules['email'] .= '|unique:users';
        }
        return Validator::make(['email' => $email], $rules);
    }

    public static function validatePassword($password)
    {
        return Validator::make(['password' => $password], [
            'password' => 'required|min:8'
        ]);
    }
}
