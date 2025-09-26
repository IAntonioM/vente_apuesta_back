<?php

namespace App\Http\Middleware;

use App\Models\NivelJuego;
use App\Services\UserJuegoService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidarMenuRetiro
{
    protected $userJuegoService;

    public function __construct(UserJuegoService $userJuegoService)
    {
        $this->userJuegoService = $userJuegoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 🔹 Verificar autenticación
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        // 🔹 Si está en el menú 3 → pasa directo
        if ($user->menu_actual == 3) {
            return $next($request);
        }

        // 🔹 Si NO está en menú 3 → verificamos el caso "TODO o NADA"
        $montoRetiro = $request->input('monto'); // el monto que el usuario quiere retirar

        // Buscar progreso en userjuegos
        $userJuego = DB::table('userjuegos')
            ->where('user_id', $user->id)
            ->first();

        if (!$userJuego) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes progreso en ningún juego'
            ], 403);
        }

        // Buscar nivelJuego actual
        $nivelJuego = NivelJuego::where('juegoId', $userJuego->juego_id)
            ->where('estado', true)
            ->where('nivel', $userJuego->nivel_actual)
            ->where('ronda', $userJuego->ronda_actual)
            ->first();

        if (!$nivelJuego) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el nivel de juego actual'
            ], 403);
        }

        // Validar TODO o NADA
        if ($nivelJuego->flag_todo_o_nada == 1) {
            if ($montoRetiro == $nivelJuego->monto_minimo_requerido) {

                // 🔹 NUEVO: Avanzar automáticamente al siguiente nivel
                $this->avanzarNivelTodoONada($user, $userJuego);

                return $next($request);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'En TODO o NADA solo puedes retirar el monto mínimo requerido',
                    'monto_minimo_requerido' => $nivelJuego->monto_minimo_requerido,
                    'monto_solicitado' => $montoRetiro
                ], 403);
            }
        }

        // ❌ Bloqueo por no estar en menú 3 ni cumplir TODO o NADA
        return response()->json([
            'success' => false,
            'message' => 'No puedes realizar retiros desde tu menú actual. Debes estar en el menú de retiro.',
            'menu_actual' => $user->menu_actual,
            'menu_requerido' => 3
        ], 403);
    }

    /**
     * Avanzar al siguiente nivel cuando retira en TODO o NADA
     */
    private function avanzarNivelTodoONada($user, $userJuego)
    {
        try {
            // Buscar el siguiente nivel/ronda
            $siguienteNivel = NivelJuego::where('juegoId', $userJuego->juego_id)
                ->where(function ($query) use ($userJuego) {
                    $query->where('ronda', '>', $userJuego->ronda_actual)
                        ->orWhere(function ($subQuery) use ($userJuego) {
                            $subQuery->where('ronda', '=', $userJuego->ronda_actual)
                                ->where('nivel', '>', $userJuego->nivel_actual);
                        });
                })
                ->orderBy('ronda', 'ASC')
                ->orderBy('nivel', 'ASC')
                ->first();

            if ($siguienteNivel) {
                // 🔹 Verificar si hay cambio de ronda
                $cambioDeRonda = $siguienteNivel->ronda > $userJuego->ronda_actual;

                // 🔹 Preparar datos para la actualización
                $datosActualizacion = [
                    'user_id'      => $user->id,
                    'juego_id'     => $userJuego->juego_id,
                    'nivel_actual' => $siguienteNivel->nivel,
                    'ronda_actual' => $siguienteNivel->ronda,
                ];

                // 🔹 Solo agregar f_ronda_update si hubo cambio de ronda
                if ($cambioDeRonda) {
                    $datosActualizacion['f_ronda_update'] = now();
                }

                // HAY siguiente nivel/ronda - avanzar
                $this->userJuegoService->crearOActualizarNivel($datosActualizacion);

                Log::info("Usuario {$user->id} avanzó automáticamente por retiro TODO o NADA", [
                    'nivel_anterior' => "{$userJuego->ronda_actual}-{$userJuego->nivel_actual}",
                    'nivel_nuevo' => "{$siguienteNivel->ronda}-{$siguienteNivel->nivel}",
                    'cambio_de_ronda' => $cambioDeRonda,
                    'f_ronda_update_actualizada' => $cambioDeRonda
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Error al avanzar nivel en TODO o NADA: " . $e->getMessage());
        }
    }
}
