<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cliente
{
  
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->roles === 'Cliente') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Acceso no autorizado'], 401);
        }
    }
}
