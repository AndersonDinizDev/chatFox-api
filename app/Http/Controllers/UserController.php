<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Utils\Validation;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(Request $request)
    {
        try {
            $validation_email = Validation::validateEmail($request->email);
            $validation_password = Validation::validatePassword($request->password);

            if ($validation_email->fails() || $validation_password->fails()) {
                return response()->json(['error' => true, 'message' => $validation_email->errors()->merge($validation_password->errors())], 422);
            }

            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => true, 'message' => 'Credenciais inválidas'], 401);
            }

            return response()->json(['success' => true, 'message' => 'Usuário autenticado com sucesso !', 'data' => ['token' => $token]]);
        } catch (JWTException $e) {
            return response()->json(['error' => true, 'message' => 'Erro ao gerar o token JWT: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation_name = Validation::validateName($request->name);
            $validation_email = Validation::validateEmail($request->email, true);
            $validation_password = Validation::validatePassword($request->password);

            if ($validation_name->fails() || $validation_email->fails() || $validation_password->fails()) {
                return response()->json(['error' => true, 'message' => $validation_name->errors()->merge($validation_email->errors()->merge($validation_password->errors()))], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['success' => true, 'message' => 'Usuário cadastrado com sucesso !', 'data' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Erro inesperado: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
