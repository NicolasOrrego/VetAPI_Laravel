<?php

namespace App\Http\Controllers\Administrador\CitaMedica;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cita;

class AdminCitaController extends Controller
{
    //TODO: Crear nueva cita médicas
    public function crearCita(Request $request)
    {
        $validacion_datos = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|max:60|min:3',
            'id_usuario' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES
            'fecha.required' => 'El campo de fecha es requerido.',
            'fecha.date_format' => 'El formato de fecha no es valido',
            'hora.required' => 'El campo de hora es requerido.',
            'hora.date_format' => 'El formato de hora no es valida',
            'motivo.required' => 'El campo motivo es requerido',
            'id_usuario.required' => 'El campo usuario es requerido',
        ]);

        $existe_cita = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)->first();

        if ($existe_cita) {
            return response()->json(['error' => 'La hora esta siendo ocupada'], 404);
        }

        $cita_medica = $validacion_datos;
        $cita_medica['fecha'] = $request->fecha;
        $cita_medica['hora'] = $request->hora;
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

        $cita_medica = Cita::create($cita_medica);
        return response()->json([
            'message' => 'Cita médica registrada exitosamente',
            'cita_medica' => $cita_medica
        ], 200);
    }

    //TODO: Obtener todos las citas médicas
    public function obtenerCita(Request $request)
    {
        $cita_medicas = Cita::all();
        if ($cita_medicas->count() > 0) {
            return response()->json([
                'cita_medicas' => $cita_medicas
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay citas médicas registradas.'
            ], 200);
        }
    }

    //TODO: Buscar cita médicas
    public function buscarCita(Request $request, $id)
    {
        $cita_medica = Cita::find($id);
        if ($cita_medica) {
            return response()->json([
                'message' => 'Cita médica encontrada',
                'cita_medica' => $cita_medica
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cita médica no encontrada'
            ], 404);
        }
    }

    //TODO: Modificar cita médica
    public function modificarCita(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i|unique:users,id|',
            'motivo' => 'required|max:60|min:3',
            'id_usuario' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES DEL USUARIO
            'fecha.required' => 'El campo de fecha es requerido.',
            'fecha.date_format' => 'El formato de fecha no es valido',
            'hora.date_format' => 'El formato de hora no es valida',
            'motivo.required' => 'El campo motivo es requerido',
            'id_usuario.required' => 'El campo usuario es requerido',
        ]);
        $existe_cita = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('id', '!=', $id)
            ->first();

        if ($existe_cita) {
            return response()->json(['error' => 'La hora esta siendo ocupada'], 404);
        }

        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['error' => 'La cita especificada no existe'], 404);
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

        $cita->update($validacion_datos);
        return response()->json(['message' => 'Cita médica modificada exitosamente', 'cita' => $cita], 200);
    }

    //TODO: Eliminar cita médica
    public function eliminarCita($id)
    {
        $cita_medica = Cita::find($id);
        if (!$cita_medica) {
            return response()->json(['error' => 'La cita médica no existe'], 404);
        }
        $cita_medica->delete();
        return response()->json(['message' => 'Cita médica eliminada exitosamente'], 200);
    }
}
