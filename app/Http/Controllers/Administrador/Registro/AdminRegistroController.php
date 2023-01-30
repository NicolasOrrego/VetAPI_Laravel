<?php

namespace App\Http\Controllers\Administrador\Registro;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jaula;
use App\Models\Paciente;
use App\Models\Rjaula;

class AdminRegistroController extends Controller
{
    //TODO: Crear registro de jaula
    public function crearRegistro(Request $request)
    {
        $validacion_datos = $request->validate([
            'id_usuario' => 'required|max:30|min:1',
            'id_paciente' => 'required|max:30|min:1',
            'id_jaula' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES
            'id_usuario.required' => 'El campo id_usuario es requerido.',
            'id_paciente.required' => 'El campo id_paciente es requerido',
            'id_jaula.required' => 'El campo id_jaula es requerido',
        ]);

        $rjaula = $validacion_datos;
        $usuario = User::find($request->id_usuario);
        $paciente = Paciente::find($request->id_paciente);
        $jaula = Jaula::find($request->id_jaula);

        if (!$usuario) {
            return response()->json(['error' => 'El usuario especificado no existe'], 404);
        }
        if (!$paciente) {
            return response()->json(['error' => 'El paciente especificado no existe'], 404);
        }
        if (!$jaula) {
            return response()->json(['error' => 'La jaula especificada no existe'], 404);
        }

        $rjaula = Rjaula::create($rjaula);
        return response()->json([
            'message' => 'Registro de jaula registrada exitosamente',
            'Registro jaula' => $rjaula
        ], 200);
    }

    //TODO: Obtener registros de jaulas
    public function obtenerRegistros(Request $request)
    {
        $rjaulas = Rjaula::all();
        if ($rjaulas->count() > 0) {
            return response()->json([
                'rjaulas' => $rjaulas
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay registro jaula registrados.'
            ], 200);
        }
    }

    //TODO: Buscar registros de jaula
    public function buscarRegistro(Request $request, $id)
    {
        $rjaula = Rjaula::find($id);
        if ($rjaula) {
            return response()->json([
                'message' => 'Registro jaula encontrado',
                'Registro jaula' => $rjaula
            ], 200);
        } else {
            return response()->json([
                'message' => 'Registro jaula no encontrado'
            ], 404);
        }
    }

    //TODO: Modificar registros de jaula
    public function modificarRegistro(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'id_usuario' => 'required|max:30|min:1',
            'id_paciente' => 'required|max:30|min:1',
            'id_jaula' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES
            'id_usuario.required' => 'El campo id_usuario es requerido.',
            'id_paciente.required' => 'El campo id_paciente es requerido',
            'id_jaula.required' => 'El campo id_jaula es requerido',
        ]);

        $rjaula = $validacion_datos;
        $usuario = User::find($request->id_usuario);
        $paciente = Paciente::find($request->id_paciente);
        $jaula = Jaula::find($request->id_jaula);

        if (!$usuario) {
            return response()->json(['error' => 'El usuario especificado no existe'], 404);
        }
        if (!$paciente) {
            return response()->json(['error' => 'El paciente especificado no existe'], 404);
        }
        if (!$jaula) {
            return response()->json(['error' => 'La jaula especificada no existe'], 404);
        }

        $rjaula = Rjaula::find($id);
        if (!$rjaula) {
            return response()->json(['error' => 'El registro de jaula no existe'], 404);
        }

        $rjaula->update($validacion_datos);
        return response()->json([
            'message' => 'Registro de jaula modificado exitosamente',
            'Registro jaula' => $rjaula
        ], 200);
    }
    //TODO: Eliminar registros de jaula
    public function eliminarRegistro(Request $request, $id)
    {
        $rjaula = Rjaula::find($id);
        if (!$rjaula) {
            return response()->json(['error' => 'El registro de jaula no existe'], 404);
        }
        $rjaula->delete();
        return response()->json(['message' => 'Registro jaula eliminada exitosamente'], 200);
    }
}
