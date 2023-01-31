<?php

namespace App\Http\Controllers\Cliente\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    //TODO: Ver información personal 
    public function informacionPersonal()
    {
        $usuario = auth()->user();
        if (!$usuario) {
            return response()->json(['error' => 'No hay usuario autenticado'], 404);
        }

        return response()->json([
            'usuario' => $usuario
        ], 200);
    }

    //TODO: Modificar informacion personal
    public function modificarInformacion(Request $request)
    {
        $usuario = auth()->user();
        if (!$usuario) {
            return response()->json(['error' => 'No hay usuario autenticado'], 404);
        }

        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'email' => 'required|max:60|email|unique:users,id|string',
            'password' => 'required|min:8|confirmed|string',
            'password_confirmation' => 'required|min:8|string',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombres es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'email.required' => 'El campo correo es requerido',
            'email.unique' => 'El email ya esta ocupado',
            'password.required' => 'El campo contraseña es requerido',
            'password_confirmation.required' => 'El campo contraseña de confirmacion es requerido',
            'password.confirmed' => 'La contraseña de confirmación no coincide',
        ]);

        $validacion_datos['password'] = Hash::make($validacion_datos['password']);
        $usuario->update($validacion_datos);
        return response()->json(['message' => 'Usuario modificado exitosamente', 'usuario' => $usuario], 200);
    }

    //TODO: Deshabilitar cuenta
    public function deshabilitarCuenta(Request $request)
    {
        $usuario = auth()->user();
        if (!$usuario) {
            return response()->json(['error' => 'No hay usuario autenticado'], 404);
        }

        $usuario->estado = 'Deshabilitado';
        $usuario->save();

        return response()->json([
            'message' => 'Cuenta deshabilitada exitosamente',
            'usuario' => $usuario
        ], 200);
    }
}
