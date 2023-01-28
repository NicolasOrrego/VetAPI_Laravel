<?php

use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\Administrador\Usuario\UsuarioController;
use App\Http\Controllers\Administrador\Paciente\AdminPacienteController;
use App\Http\Controllers\Administrador\Jaula\AdminJaulaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
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
    Route::middleware(['administrador'])->group(function () {
        Route::get('/v1/administrador', function () {
            return response()->json(['message' => 'Bievenido Usuario Administrador']);
        });

        //TODO: CRUD usuario
        //* Crear nuevo usuario
        Route::post('/v1/administrador/registrar/usuario', [UsuarioController::class, 'crearUsuario']);

        //* Ver todos los usuarios
        Route::get('/v1/administrador/lista/usuario', [UsuarioController::class, 'obtenerUsuarios']);

        //* Ver todos los usuarios administradores
        Route::get('/v1/administrador/lista/administradores/usuarios', [UsuarioController::class, 'usuariosAdministrador']);

        //* Ver todos los usuarios funcionarios
        Route::get('/v1/administrador/lista/funcionarios/usuarios', [UsuarioController::class, 'usuariosFuncionarios']);

        //* Ver todos los usuarios clientes
        Route::get('/v1/administrador/lista/clientes/usuarios', [UsuarioController::class, 'usuariosClientes']);

        //* Buscar usuario
        Route::get('/v1/administrador/buscar/usuario/{id}', [UsuarioController::class, 'buscarUsuario']);

        //* Modificar usuario
        Route::put('/v1/administrador/modificar/usuario/{id}', [UsuarioController::class, 'modificarUsuario']);

        //* Eliminar usuario
        Route::delete('/v1/administrador/eliminar/usuario/{id}', [UsuarioController::class, 'eliminarUsuario']);

        //TODO: CRUD paciente
        //* Registrar paciente
        Route::post('/v1/administrador/registrar/paciente', [AdminPacienteController::class, 'crearPaciente']);

        //* Ver todos los pacientes
        Route::get('/v1/administrador/lista/pacientes', [AdminPacienteController::class, 'obtenerPacientes']);

        //* Buscar paciente
        Route::get('/v1/administrador/buscar/paciente/{id}', [AdminPacienteController::class, 'buscarPaciente']);

        //* Modificar paciente
        Route::put('/v1/administrador/modificar/paciente/{id}', [AdminPacienteController::class, 'modificarPaciente']);

        //* Eliminar paciente
        Route::delete('/v1/administrador/eliminar/paciente/{id}', [AdminPacienteController::class, 'eliminarPaciente']);

        //TODO: CRUD jaula
        //* Registar jaula
        Route::post('/v1/administrador/registrar/jaula', [AdminJaulaController::class, 'crearJaula']);

        //* Ver todos los jaulas
        Route::get('/v1/administrador/lista/jaulas', [AdminJaulaController::class, 'obtenerJaulas']);

        //* Buscar jaula
        Route::get('/v1/administrador/buscar/jaula/{id}', [AdminJaulaController::class, 'buscarJaula']);

        //* Modificar jaula
        Route::put('/v1/administrador/modificar/jaula/{id}', [AdminJaulaController::class, 'modificarJaula']);

        //* Eliminar jaula
        Route::delete('/v1/administrador/eliminar/jaula/{id}', [AdminJaulaController::class, 'eliminarJaula']);
    });

    


    //TODO: Rutas del usuario funcionario
    Route::middleware(['funcionario'])->group(function () {
        Route::get('/v1/funcionario', function () {
            return response()->json(['message' => 'Bievenido Usuario Funcionario']);
        });
    });

    //TODO: Rutas del usuario cliente
    Route::middleware(['cliente'])->group(function () {
        Route::get('/v1/cliente', function () {
            return response()->json(['message' => 'Bievenido Usuario Cliente']);
        });
    });
});
