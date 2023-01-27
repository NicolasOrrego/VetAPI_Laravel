<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Funcionario
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->roles === 'Funcionario') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Acceso no autorizado'], 401);
        }
    }
}
