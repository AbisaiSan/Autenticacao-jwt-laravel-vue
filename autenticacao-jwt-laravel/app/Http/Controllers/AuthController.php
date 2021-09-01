<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        
        $credentials = [
            'email'=>$input['email'], 
            'password'=>$input['password'],
        ];

        //Acontece a verificação caso as crendenciais sejam verdadeiras
        //Caso as crendenciais enviados forem corretas, ele envia o token, se não retorna o erro
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
            
        }
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
           
    }

}
