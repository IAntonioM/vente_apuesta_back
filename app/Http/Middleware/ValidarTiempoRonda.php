<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\CronometroRondaService;
use App\Services\SaldoService;
use App\Services\TransaccionService;
use App\Services\UserJuegoService;
use App\Services\SaldoUsuarioService;
use Symfony\Component\HttpFoundation\Response;

class ValidarTiempoRonda
{
    protected $cronometroService;
    protected $transaccionService;
    protected $userJuegoService;
    protected $saldoUsuarioService;

    public function __construct(
        UserJuegoService $cronometroService,
        TransaccionService $transaccionService,
        UserJuegoService $userJuegoService,
        SaldoService $saldoUsuarioService
    ) {
        $this->cronometroService = $cronometroService;
        $this->transaccionService = $transaccionService;
        $this->userJuegoService = $userJuegoService;
        $this->saldoUsuarioService = $saldoUsuarioService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // 🔹 Obtener el usuario autenticado
            $user = $request->user();

            // 🔹 Verificar que el usuario esté autenticado
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado'
                ], 401);
            }

            // 🔹 Verificar el tiempo restante del cronómetro
            $cronometro = $this->cronometroService->calcularTiempoRestante($user->id, 1); // Siempre juego 1

            // 🔹 SI LE QUEDA TIEMPO - Prosigue todo normal
            if (!$cronometro['tiempo_agotado']) {
                Log::info("Usuario {$user->id} tiene tiempo restante", [
                    'tiempo_restante' => $cronometro['tiempo_restante'],
                ]);
                return $next($request);
            }

            // 🔹 SI NO LE QUEDA TIEMPO - Ejecutar penalización
            Log::warning("Usuario {$user->id} se quedó sin tiempo - Aplicando penalización");

            // 🔹 Obtener saldo actual del usuario
            $saldoUsuario = $this->saldoUsuarioService->getSaldoByUser($user->id);

            if (!$saldoUsuario || $saldoUsuario->saldo <= 0) {
                // Si no tiene saldo o ya está en 0, solo actualizar tiempo
                $this->actualizarTiempoRonda($user->id);

                return response()->json([
                    'success' => false,
                    'message' => 'Su tiempo ha llegado al límite. No tiene saldo acumulado para penalizar.',
                    'tiempo_agotado' => true,
                    'saldo_actual' => 0
                ], 403);
            }

            $montoARetirar = $saldoUsuario->saldo;

            // 🔹 Crear transacción de RETIRO (penalización por tiempo agotado)
            $dataTransaccion = [
                'userId'           => $user->id,
                'tipo'             => 'RETIRO',
                'monto'            => $montoARetirar,
                'metodo_pago'      => '',  // vacío
                'observacion'      => 'Su tiempo límite ha caducado, se le quita todo lo acumulado',
                'flag_transaccion' => 0,   // default en 0
                'referencia'       => '',   // vacío
                'flag_crearSolicitud' => 0,
            ];

            // 🔹 Crear la transacción (esto automáticamente actualiza el saldo a 0)
            $transaccion = $this->transaccionService->crearTransaccion($dataTransaccion);

            // 🔹 Actualizar f_ronda_update con fecha actual
            $this->actualizarTiempoRonda($user->id);

            Log::info("Penalización aplicada al usuario {$user->id}", [
                'monto_retirado' => $montoARetirar,
                'transaccion_id' => $transaccion->id ?? 'N/A',
                'saldo_anterior' => $montoARetirar,
                'saldo_nuevo' => 0
            ]);

            // 🔹 Devolver mensaje de penalización
            return response()->json([
                'success' => false,
                'message' => 'Su tiempo ha llegado al límite (se le quitará todo lo acumulado)',
                'tiempo_agotado' => true,
                'penalizacion_aplicada' => true,
                'monto_penalizado' => $montoARetirar,
                'saldo_actual' => 0,
                'transaccion_id' => $transaccion->id ?? null
            ], 403); // 403 = Forbidden

        } catch (Exception $e) {
            Log::error('Error en middleware ValidarTiempoRonda: ' . $e->getMessage(), [
                'user_id' => $request->user()->id ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error interno al validar tiempo de ronda'
            ], 500);
        }
    }

    /**
     * Actualizar f_ronda_update con la fecha actual
     */
    private function actualizarTiempoRonda(int $userId): void
    {
        try {
            $datosActualizacion = [
                'user_id' => $userId,
                'juego_id' => 1, // Siempre juego 1
                'f_ronda_update' => now()
            ];

            // 🔹 Solo actualizar el tiempo, mantener nivel y ronda actuales
            $this->userJuegoService->actualizarSoloTiempo($datosActualizacion);
        } catch (Exception $e) {
            Log::error('Error al actualizar f_ronda_update: ' . $e->getMessage());
        }
    }
}

// ==================== MÉTODO ADICIONAL PARA EL SERVICIO ====================
/*
Agregar este método a tu UserJuegoService:


*/

// ==================== REGISTRO DEL MIDDLEWARE ====================
/*
En app/Http/Kernel.php, agregar en $routeMiddleware:

'validar.tiempo.ronda' => \App\Http\Middleware\ValidarTiempoRonda::class,
*/

// ==================== USO EN RUTAS ====================
/*
Route::middleware(['auth:sanctum', 'validar.tiempo.ronda'])->group(function () {
    Route::post('/jugar', [JuegoController::class, 'jugar']);
    Route::post('/guardar-nivel', [JuegoController::class, 'guardarNivel']);
    // Otras rutas que requieran validación de tiempo
});
*/
