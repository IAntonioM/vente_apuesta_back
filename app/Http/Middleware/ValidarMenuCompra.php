<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidarMenuCompra
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 🔹 Obtener el usuario autenticado
        $user = $request->user();

        // 🔹 Verificar que el usuario esté autenticado
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        // 🔹 Verificar que el menu_actual sea 1 (menú de compras)
        if ($user->menu_actual != 1) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes realizar compras desde tu menú actual. Debes estar en el menú de compras.',
                'menu_actual' => $user->menu_actual,
                'menu_requerido' => 1
            ], 403); // 403 = Forbidden
        }

        // 🔹 Si todo está bien, continúa con la petición
        return $next($request);
    }
}
