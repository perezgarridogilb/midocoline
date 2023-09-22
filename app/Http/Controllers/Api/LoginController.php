<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;


class LoginController extends Controller
{
    /**
     * Funcion de inicio de sesion
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request) {
        $this->validateLogin($request);
        
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'Success'
            ],  Response::HTTP_ACCEPTED);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Funcion para validaciones en el inicio de sesion
     *
     * @param Request $request
     * @return void
     */
    public function validateLogin(Request $request) {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'password' => 'required|string|min:3',
        ]);
    }

    /**
     * Funcion para registrar usuarios
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request) {
        // Validar los datos de registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
        ]);
    
        // Crear un nuevo usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    
        return response()->json([
            'Status' => 'Success',
            'Message' => 'Usuario registrado con éxito',
        ], Response::HTTP_CREATED);
    }
}
