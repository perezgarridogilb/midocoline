<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'name' => 'required'
        ]);
    }
}
