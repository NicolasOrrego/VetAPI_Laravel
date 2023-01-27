<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrador
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->roles === 'Administrador') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Acceso no autorizado'], 401);
        }
    }
}
