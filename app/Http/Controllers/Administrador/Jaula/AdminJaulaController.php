<?php

namespace App\Http\Controllers\Administrador\Jaula;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jaula;

class AdminJaulaController extends Controller
{
    //TODO: Crear nueva jaula
    public function crearJaula(Request $request)
    {
        $validacion_datos = $request->validate([
            'dimensiones' => 'required|max:30|min:3',
            'material' => 'required|max:60|string',
        ], [
            //! VALIDACIONES
            'dimensiones.required' => 'El campo dimension es requerido.',
            'material.required' => 'El campo material es requerido',
        ]);

        $jaula = $validacion_datos;
        $jaula = Jaula::create($jaula);

        return response()->json([
            'message' => 'Jaula registrada exitosamente',
            'jaula' => $jaula
        ], 200);
    }

    //TODO: Obtener todas las jaulas
    public function obtenerJaulas(Request $request)
    {
        $jaulas = Jaula::all();
        if ($jaulas->count() > 0) {
            return response()->json([
                'jaulas' => $jaulas
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay jaulas registradas.'
            ], 200);
        }
    }

    //TODO: Buscar jaula
    public function buscarJaula(Request $request, $id)
    {
        $jaula = Jaula::find($id);
        if ($jaula) {
            return response()->json([
                'message' => 'Jaula encontrada',
                'jaula' => $jaula
            ], 200);
        } else {
            return response()->json([
                'message' => 'Jaula no encontrada'
            ], 404);
        }
    }

    //TODO: Modificar jaula
    public function modificarJaula(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'dimensiones' => 'required|max:30|min:3',
            'material' => 'required|max:60|string',
        ], [
            //! VALIDACIONES
            'dimensiones.required' => 'El campo dimension es requerido.',
            'material.required' => 'El campo material es requerido',
        ]);
        $jaula = Jaula::find($id);
        if (!$jaula) {
            return response()->json(['error' => 'La jaula no existe'], 404);
        }
        $jaula->update($validacion_datos);
        return response()->json(['message' => 'Jaula modificada exitosamente', 'jaula' => $jaula], 200);
    }

    //TODO: Eliminar jaula
    public function eliminarJaula($id)
    {
        $jaula = Jaula::find($id);
        if (!$jaula) {
            return response()->json(['error' => 'La jaula no existe'], 404);
        }
        $jaula->delete();
        return response()->json(['message' => 'Jaula eliminada exitosamente'], 200);
    }
}
