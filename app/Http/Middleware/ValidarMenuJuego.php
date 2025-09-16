<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ValidarMenuJuego
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

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        $puedePasar = false;

        // 🔹 Obtener el progreso actual del usuario en un juego
        $userJuego = DB::table('userjuegos')
            ->where('user_id', $user->id)
            ->first();

        if ($userJuego) {
            $nivelJuego = \App\Models\NivelJuego::where('juegoId', $userJuego->juego_id)
                ->where('nivel', $userJuego->nivel_actual ?? 1)
                ->where('ronda', $userJuego->ronda_actual ?? 1)
                ->where('estado', true)
                ->first();

            if ($nivelJuego && $nivelJuego->flag_todo_o_nada == 1) {
                $puedePasar = true;
            }
        }

        // 🔹 Validar menu_actual solo si no es un nivel "todo o nada"
        if (!$puedePasar && $user->menu_actual != 2) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes jugar desde tu menú actual. Debes estar en el menú de juego.',
                'menu_actual' => $user->menu_actual,
                'menu_requerido' => 2
            ], 403);
        }

        return $next($request);
    }
}
