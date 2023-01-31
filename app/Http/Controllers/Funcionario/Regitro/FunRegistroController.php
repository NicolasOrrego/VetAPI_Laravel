<?php

namespace App\Http\Controllers\Funcionario\Regitro;

use App\Models\Jaula;
use App\Models\Rjaula;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunRegistroController extends Controller
{
    //TODO: Crear registro de jaula
    public function crearRegistro(Request $request)
    {
        $validacion_datos = $request->validate([
            'id_paciente' => 'required|max:30|min:1',
            'id_jaula' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES
            'id_paciente.required' => 'El campo id_paciente es requerido',
            'id_jaula.required' => 'El campo id_jaula es requerido',
        ]);

        $usuario = auth()->user();
        $paciente = Paciente::find($request->id_paciente);
        $jaula = Jaula::find($request->id_jaula);

        if ($usuario->roles !== "Funcionario" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'Solo los funcionarios que se encuentren habilitados pueden hacer registro de jaula'], 403);
        }
        if (!$paciente) {
            return response()->json(['error' => 'El paciente especificado no existe'], 404);
        }
        if (!$jaula) {
            return response()->json(['error' => 'La jaula especificada no existe'], 404);
        }

        $rjaula = $validacion_datos;
        $rjaula['id_usuario'] = $usuario->id;
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
            'id_paciente' => 'required|max:30|min:1',
            'id_jaula' => 'required|max:30|min:1'
        ], [
            //! VALIDACIONES
            'id_paciente.required' => 'El campo id_paciente es requerido',
            'id_jaula.required' => 'El campo id_jaula es requerido',
        ]);

        $usuario = auth()->user();
        $paciente = Paciente::find($request->id_paciente);
        $jaula = Jaula::find($request->id_jaula);

        if ($usuario->roles !== "Funcionario" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'Solo los funcionarios que se encuentren habilitados pueden hacer registro de jaula'], 403);
        }
        if (!$paciente) {
            return response()->json(['error' => 'El paciente especificado no existe'], 404);
        }
        if (!$jaula) {
            return response()->json(['error' => 'La jaula especificada no existe'], 404);
        }
        $rjaula = $validacion_datos;
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
