<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // 1. Valida las credenciales. Si fallan, devuelve el error.
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // 2. Si las credenciales son correctas, obtenemos el usuario que acaba de iniciar sesión.
        $user = JWTAuth::user();

        // 3. Definimos los datos extra que queremos añadir al token (el rol).
        $customClaims = ['role' => $user->role];

        // 4. Generamos un nuevo token a partir del usuario, pero esta vez
        //    incluyendo los datos extra que definimos.
        $tokenWithRole = JWTAuth::claims($customClaims)->fromUser($user);

        // 5. Devolvemos el nuevo token que ya contiene el rol.
        return response()->json(['token' => $tokenWithRole]);
    }

    public function me()
    {
        return response()->json(JWTAuth::parseToken()->authenticate());
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
