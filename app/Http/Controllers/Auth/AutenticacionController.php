<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AutenticacionController extends Controller
{
    //TODO: Registrar usuario
    public function registerUsuario(Request $request){
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'email' => 'required|max:60|email|unique:users|string',
            'password' => 'required|min:8|confirmed|string',
        ], [
                //! VALIDACIONES DEL USUARIO
                'nombres.required' => 'El campo nombres es requerido',
                'apellidos.required' => 'El campo apellidos es requerido',
                'email.required' => 'El campo correo es requerido',
                'password.required' => 'El campo contraseña es requerido',
                'password.confirmed' => 'La contraseña de confirmación no coincide',
                'correo.unique' => 'El correo ya esta en uso',
            ]);

        $usuario = $validacion_datos;
        $usuario['password'] = Hash::make($request->password);
        $usuario = User::create($usuario);

        return response($usuario, Response::HTTP_CREATED);
    }

    //TODO: Iniciar sesión
    public function loginUsuario(Request $request){
        $validacion_datos = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
                //!VALIDACION DE LOGIN
                'email.required' => 'El campo correo es requerido',
                'password.required' => 'El campo contraseña es requerido',
            ]);

            if (Auth::attempt($validacion_datos)) {
                $usuario = Auth::user();
                $token = $usuario->createToken('token')->plainTextToken;
                $cookie = cookie('cookie_token', $token, 60 * 24);
                if ($usuario->roles == 1) {
                    return response()->json(['message' => 'Te has logeado como administrador', "token" => $token],200);
                } elseif ($usuario->roles == 2) {
                    return response()->json(['message' => 'Te has logeado como funcionario', "token" => $token],200);
                } else {
                    return response()->json(['message' => 'Te has logeado como cliente', "token" => $token],200);                }
            }
            return response($usuario, Response::HTTP_UNAUTHORIZED);
    }
}