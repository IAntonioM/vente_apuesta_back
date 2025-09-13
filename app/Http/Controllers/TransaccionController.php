<?php

namespace App\Http\Controllers;

use App\Models\UserJuego;
use App\Services\TransaccionService;
use Illuminate\Http\Request;
use Exception;

class TransaccionController extends Controller
{
    protected $transaccionService;

    public function __construct(TransaccionService $transaccionService)
    {
        $this->transaccionService = $transaccionService;
    }

    // DEPÓSITO
    public function crearDeposito(Request $request)
    {
        try {
            $data = [
                'userId'      => $request->user()->id,
                'tipo'        => 'DEPOSITO',
                'monto'       => $request->input('monto'),
                'metodo_pago' => $request->input('metodo_pago'),
                'referencia'  => $request->input('referencia'),
                'observacion' => $request->input('observacion'),
                'flag_transaccion' => 1,
            ];

            $transaccion = $this->transaccionService->crearTransaccion($data);
            return response()->json($transaccion, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al registrar depósito'], 400);
        }
    }
    // RETIRO
    public function crearRetiro(Request $request)
    {
        try {
            $user = $request->user();

            $data = [
                'userId'          => $user->id,
                'tipo'            => 'RETIRO',
                'monto'           => $request->input('monto'),
                'metodo_pago'     => $request->input('metodo_pago'),
                'observacion'     => $request->input('observacion'),
                'flag_transaccion' => 1,
                'referencia'      => $request->input('referencia'),
            ];

            // Crear la transacción
            $transaccion = $this->transaccionService->crearTransaccion($data);

            // ✅ Si todo fue bien, actualizar flag_puede_retirar en 0
            $user->update(['flag_puede_retirar' => 0]);

            // ✅ Traer UserJuego con juego_id = 1
            $userJuego = UserJuego::firstOrCreate(
                ['user_id' => $user->id, 'juego_id' => 1],
                ['nivel_actual' => 1, 'ronda_actual' => 1] // valores iniciales si no existe
            );

            return response()->json([
                'message' => 'Retiro exitoso',
                'transaccion' => $transaccion,
                'user' => $user,
                'userJuego' => $userJuego
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al registrar retiro'], 400);
        }
    }


    // LISTADO
    public function misTransacciones(Request $request)
    {
        try {
            $lista = $this->transaccionService->getMisTransacciones($request->user()->id);
            return response()->json($lista);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener transacciones'], 500);
        }
    }
}
