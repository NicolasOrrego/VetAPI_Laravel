<?php

namespace App\Http\Controllers\Administrador\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //TODO: Crear nuevo usuario
    public function crearUsuario(Request $request){
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'email' => 'required|max:60|email|unique:users|string',
            'password' => 'required|min:8|confirmed|string',
            'password_confirmation' => 'required|min:8|string',
            'roles' => 'required|string|in:Administrador,Cliente,Funcionario',
        ], [
                //! VALIDACIONES DEL USUARIO
                'nombres.required' => 'El campo nombres es requerido',
                'apellidos.required' => 'El campo apellidos es requerido',
                'email.required' => 'El campo correo es requerido',
                'email.unique' => 'El email ya esta ocupado',
                'password.required' => 'El campo contraseña es requerido',
                'password_confirmation.required' => 'El campo contraseña de confirmacion es requerido',
                'password.confirmed' => 'La contraseña de confirmación no coincide',
                'correo.unique' => 'El correo ya esta en uso',
                'roles.required' => 'El campo rol requerido es requerido',
                'roles.in' => 'El rol seleccionado no es válido. Por favor seleccione entre Administrador, Cliente o Funcionario'
            ]);

            $usuario = $validacion_datos;
            $usuario['password'] = Hash::make($request->password);
            $usuario = User::create($usuario);
    
            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'usuario' => $usuario],200);
    }

    //TODO: Obtener todos los usuarios
    public function obtenerUsuarios(Request $request){
        $usuarios = User::all();
        if ($usuarios->count() > 0) {
            return response()->json([
                'usuarios' => $usuarios
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay usuarios registrados.'
            ], 204);
        }
    }

    //TODO: Obtener todos los usuarios tipo administrador
    public function usuariosAdministrador(Request $request){
        $administradores = User::where('roles', 'Administrador')->get();
        if(count($administradores)>0){
            return response()->json([
                'administradores' => $administradores], 200);
        }
        else{
            return response()->json([
                'message' => 'No hay administradores registrados.'], 404);
        }
    }

    //TODO: Obtener todos los usuarios tipo funcionarios
    public function usuariosFuncionarios(Request $request){
        $funcionarios = User::where('roles', 'Funcionario')->get();
        if(count($funcionarios)>0){
            return response()->json([
                'funcionarios' => $funcionarios], 200);
        }
        else{
            return response()->json([
                'message' => 'No hay funcionarios registrados.'], 404);
        }
    }

    //TODO: Obtener todos los usuarios tipo clientes
    public function usuariosClientes(Request $request){
        $clientes = User::where('roles', 'Cliente')->get();
        if(count($clientes)>0){
            return response()->json([
                'clientes' => $clientes], 200);
        }
        else{
            return response()->json([
                'message' => 'No hay clientes registrados.'], 404);
        }
}

    //TODO: Buscar usuario
    public function buscarUsuario(Request $request, $id){
        $usuario = User::find($id);
        if($usuario){
            return response()->json([
                'message' => 'Usuario encontrado',
                'usuario' => $usuario],200);
        }else{
            return response()->json([
                'message' => 'Usuario no encontrado'],404);
        }
    }

    //TODO: Modificar usuario
    public function modificarUsuario(Request $request, $id){
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'email' => 'required|max:60|email|unique:users,id|string',
            'password' => 'required|min:8|confirmed|string',
            'password_confirmation' => 'required|min:8|string',
            'roles' => 'required|string|in:Administrador,Cliente,Funcionario',
            'estado' => 'required|string|in:Habilitado,Deshabilitado'
        ], [
                //! VALIDACIONES DEL USUARIO
                'nombres.required' => 'El campo nombres es requerido',
                'apellidos.required' => 'El campo apellidos es requerido',
                'email.required' => 'El campo correo es requerido',
                'email.unique' => 'El email ya esta ocupado',
                'password.required' => 'El campo contraseña es requerido',
                'password_confirmation.required' => 'El campo contraseña de confirmacion es requerido',
                'password.confirmed' => 'La contraseña de confirmación no coincide',
                'correo.unique' => 'El correo ya esta en uso',
                'roles.required' => 'El campo rol requerido es requerido',
                'roles.in' => 'El rol seleccionado no es válido. Por favor seleccione entre Administrador, Cliente o Funcionario',
                'estado.required' => 'El campo estado requerido es requerido',
                'estado.in' => 'El estado seleccionado no es válido. Por favor seleccione entre Habilitado o Deshabilitado'
            ]);
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe'], 404);
        }
        $validacion_datos['password'] = Hash::make($validacion_datos['password']);
        $usuario->update($validacion_datos);
        return response()->json(['message' => 'Usuario modificado exitosamente', 'usuario' => $usuario], 200);
    }
    
     //TODO: Eliminar usuario
     public function eliminarUsuario($id){
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe'], 404);
        }
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
    }

}