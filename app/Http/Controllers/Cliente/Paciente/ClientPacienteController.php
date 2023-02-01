<?php

namespace App\Http\Controllers\Cliente\Paciente;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientPacienteController extends Controller
{
    //TODO: Crear paciente nuevo
    public function crearPaciente(Request $request)
    {
        $validacion_datos = $request->validate([
            'nombre' => 'required|max:30|min:3',
            'especie' => 'required|max:60|string',
            'sexo' => 'required|string|in:Macho,Hembra'
        ], [
            //! VALIDACIONES
            'nombre.required' => 'El campo nombre es requerido',
            'especie.required' => 'El campo especie es requerido',
            'sexo.required' => 'El campo sexo requerido es requerido',
            'sexo.in' => 'El sexo seleccionado no es válido. Por favor seleccione entre Macho o Hembra'
        ]);

        $usuario = auth()->user();

        if ($usuario->roles !== "Cliente" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }

        $paciente = $validacion_datos;
        $paciente['id_usuario'] = $usuario->id;
        $paciente = Paciente::create($paciente);
        return response()->json([
            'message' => 'Paciente registrado exitosamente',
            'paciente' => $paciente
        ], 200);
    }

    //TODO: Mostrar pacientes registrados
    public function obtenerPacientes()
    {
        $usuario = auth()->user();
        $pacientes = Paciente::where('id_usuario', $usuario->id)->get();

        if ($pacientes->count() == 0) {
            return response()->json(['message' => 'No existen pacientes registrados en esta cuenta.'], 200);
        } else {
            return response()->json(['pacientes' => $pacientes], 200);
        }
    }

    //TODO: Modificar pacientes
    public function modificarPaciente(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'nombre' => 'required|max:30|min:3',
            'especie' => 'required|max:60|string',
            'sexo' => 'required|string|in:Macho,Hembra'
        ], [
            //! VALIDACIONES
            'nombre.required' => 'El campo nombre es requerido',
            'especie.required' => 'El campo especie es requerido',
            'sexo.required' => 'El campo sexo requerido es requerido',
            'sexo.in' => 'El sexo seleccionado no es válido. Por favor seleccione entre Macho o Hembra'
        ]);

        $usuario = auth()->user();
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
        
        if ($paciente->id_usuario != $usuario->id) {
            return response()->json(['error' => 'No tienes permiso para modificar este paciente'], 403);
        }

        if ($usuario->roles !== "Cliente" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }

        $paciente->update($validacion_datos);
        return response()->json(['message' => 'Paciente  modificado exitosamente', 'paciente' => $paciente], 200);
    }
}
