<?php
use App\Http\Controllers\Auth\AutenticacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

//TODO: RUTA DE REGISTRARSE
Route::post('/v1/Registrarse', [AutenticacionController::class, 'registerUsuario']);

//TODO: RUTA DE INICIAR SESION
Route::post('/v1/Login', [AutenticacionController::class, 'loginUsuario']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

