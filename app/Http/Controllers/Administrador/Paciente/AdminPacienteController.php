<?php

namespace App\Http\Controllers\Administrador\Paciente;

use App\Models\User;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPacienteController extends Controller
{
    //TODO: Crear nuevo paciente
    public function crearPaciente(Request $request)
    {
        $validacion_datos = $request->validate([
            'id_usuario' => 'required|max:30|min:1',
            'nombre' => 'required|max:30|min:3',
            'especie' => 'required|max:60|string',
            'sexo' => 'required|string|in:Macho,Hembra'
        ], [
            //! VALIDACIONES
            'id_usuario.required' => 'El campo id_usuario es requerido.',
            'nombre.required' => 'El campo nombre es requerido',
            'especie.required' => 'El campo especie es requerido',
            'sexo.required' => 'El campo sexo requerido es requerido',
            'sexo.in' => 'El sexo seleccionado no es válido. Por favor seleccione entre Macho o Hembra'
        ]);

        $paciente = $validacion_datos;
        $usuario = User::find($request->id_usuario);
        if (!$usuario) {
            return response()->json(['error' => 'El usuario especificado no existe'], 404);
        }
        if ($usuario->roles !== "Cliente") {
            return response()->json(['error' => 'El usuario especificado no es cliente'], 403);
        }
        if ($usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }
        $paciente = Paciente::create($paciente);
        return response()->json([
            'message' => 'Paciente registrado exitosamente',
            'paciente' => $paciente
        ], 200);
    }

    //TODO: Obtener todos los pacientes
    public function obtenerPacientes(Request $request)
    {
        $pacientes = Paciente::all();
        if ($pacientes->count() > 0) {
            return response()->json([
                'pacientes' => $pacientes
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay pacientes registrados.'
            ], 200);
        }
    }


    //TODO: Buscar paciente
    public function buscarPaciente(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        if ($paciente) {
            return response()->json([
                'message' => 'Paciente encontrado',
                'paciente' => $paciente
            ], 200);
        } else {
            return response()->json([
                'message' => 'Paciente no encontrado'
            ], 404);
        }
    }

    //TODO: Modificar paciente
    public function modificarPaciente(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'id_usuario' => 'required|max:30|min:1',
            'nombre' => 'required|max:30|min:3',
            'especie' => 'required|max:60|string',
            'sexo' => 'required|string|in:Macho,Hembra'
        ], [
            //! VALIDACIONES
            'id_usuario.required' => 'El campo id_usuario es requerido.',
            'nombre.required' => 'El campo nombre es requerido',
            'especie.required' => 'El campo especie es requerido',
            'sexo.required' => 'El campo sexo requerido es requerido',
            'sexo.in' => 'El sexo seleccionado no es válido. Por favor seleccione entre Macho o Hembra'
        ]);
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'El paciente no existe'], 404);
        }
        $usuario = User::find($request->id_usuario);
        if (!$usuario) {
            return response()->json(['error' => 'El usuario especificado no existe'], 404);
        }
        if ($usuario->roles !== "Cliente") {
            return response()->json(['error' => 'El usuario especificado no es cliente'], 403);
        }
        if ($usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }
        $paciente->update($validacion_datos);
        return response()->json(['message' => 'Paciente modificado exitosamente', 'paciente' => $paciente], 200);
    }

    //TODO: Eliminar paciente
    public function eliminarPaciente($id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'El paciente no existe'], 404);
        }
        $paciente->delete();
        return response()->json(['message' => 'Paciente eliminado exitosamente'], 200);
    }
}
