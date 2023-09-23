<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Funcion de inicio de sesion
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'El usuario inició sesión',
                'Token' => $request->user()->createToken($request->name)->plainTextToken
            ],  Response::HTTP_ACCEPTED);
        }

        return response()->json([
            'Status' => 'Error',
            'Message' => 'Acceso no autorizado. Por favor, inicie sesión para continuar.',
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Funcion para validaciones en el inicio de sesion
     *
     * @param Request $request
     * @return void
     */
    public function validateLogin(Request $request)
    {
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
    public function register(Request $request)
    {
        // Validar los datos de registro
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
        ]);

        // Verificar si la validacion falla
        if ($validation->fails()) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Error correspondiente a la validación',
                'Errors' => $validation->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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

    /**
     * Cerrar la sesión del usuario autenticado
     *
     * @return void
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete(); // Revoca todos los tokens del usuario
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Sesión cerrada correctamente.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Error al cerrar la sesión',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
