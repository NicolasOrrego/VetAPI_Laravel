<?php

namespace App\Http\Controllers\Cliente\Cita;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientCitaController extends Controller
{
    public function crearCita(Request $request)
    {
        $validacion_datos = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|max:60|min:3',
            ''
        ], [
            //! VALIDACIONES
            'fecha.required' => 'El campo de fecha es requerido.',
            'fecha.date_format' => 'El formato de fecha no es valido',
            'hora.date_format' => 'El formato de hora no es valida',
            'motivo.required' => 'El campo motivo es requerido',
        ]);

        $usuario = auth()->user();
        $existe_cita = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)->first();

        if ($existe_cita) {
            return response()->json(['error' => 'La hora esta siendo ocupada'], 404);
        }
        if ($usuario->roles !== "Cliente") {
            return response()->json(['error' => 'El usuario especificado no es cliente'], 404);
        }
        if ($usuario->roles !== "Cliente" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }
        $cita_medica = $validacion_datos;
        $cita_medica['fecha'] = $request->fecha;
        $cita_medica['hora'] = $request->hora;
        $cita_medica['id_usuario'] = $usuario->id;
        $cita_medica = Cita::create($cita_medica);
        return response()->json([
            'message' => 'Cita médica registrada exitosamente',
            'cita_medica' => $cita_medica
        ], 200);
    }

    //TODO: Obtener todos las citas médicas
    public function obtenerCita(Request $request)
    {
        $usuario = auth()->user();
        $cita_medicas = Cita::where('id_usuario', $usuario->id)->get();

        if ($cita_medicas->count() == 0) {
            return response()->json(['message' => 'No existen citas médicas registrados en esta cuenta.'], 200);
        } else {
            return response()->json(['Cita médicas' => $cita_medicas], 200);
        }
    }

    //TODO: Buscar cita médicas
    public function buscarCita(Request $request, $id)
    {
        $cita_medica = Cita::find($id);
        $usuario = auth()->user();
        if (!$cita_medica) {
            return response()->json([
                'message' => 'Cita médica no encontrada'
            ], 404);
        }
        if ($cita_medica->id_usuario !== $usuario->id) {
            return response()->json([
                'message' => 'La cita médica buscada no pertenece al usuario autenticado'
            ], 403);
        }
        return response()->json([
            'message' => 'Cita médica encontrada',
            'Cita médica' => $cita_medica
        ], 200);
    }


    //TODO: Modificar cita médica
    public function modificarCita(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|max:60|min:3',
        ], [
            //! VALIDACIONES DEL USUARIO
            'fecha.required' => 'El campo de fecha es requerido.',
            'fecha.date_format' => 'El formato de fecha no es valido',
            'hora.date_format' => 'El formato de hora no es valida',
            'motivo.required' => 'El campo motivo es requerido',
        ]);
        $usuario = auth()->user();
        $existe_cita = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)->first();

        if ($existe_cita) {
            return response()->json(['error' => 'La hora esta siendo ocupada'], 404);
        }
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['error' => 'La cita especificada no existe'], 404);
        }
        if ($usuario->roles !== "Cliente") {
            return response()->json(['error' => 'El usuario especificado no es cliente'], 404);
        }
        if ($usuario->roles !== "Cliente" || $usuario->estado !== "Habilitado") {
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
