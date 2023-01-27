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

//TODO: Ruta de autenticación

    //* Registrarse
    Route::post('/v1/registrarse', [AutenticacionController::class, 'registerUsuario']);

    //* Iniciar sesión
    Route::post('/v1/login', [AutenticacionController::class, 'loginUsuario']);

//TODO: Rutas generales 
        Route::middleware(['auth:sanctum'])->group(function () {

            //* Cerrar sesión
            Route::get('/v1/logout', [AutenticacionController::class, 'logoutUsuario']);
            
            //TODO: Rutas del usuario adminstrador
            Route::middleware(['administrador'])->group(function(){
                Route::get('/v1/administrador', function () {return response()->json(['message' => 'Bievenido Usuario Administrador']);});
            });  

            //TODO: Rutas del usuario funcionario
            Route::middleware(['funcionario'])->group(function(){
                Route::get('/v1/funcionario', function () {return response()->json(['message' => 'Bievenido Usuario Funcionario']);});
            });

            //TODO: Rutas del usuario cliente
            Route::middleware(['cliente'])->group(function(){
                Route::get('/v1/cliente', function () {return response()->json(['message' => 'Bievenido Usuario Cliente']);});
            });
        });
    