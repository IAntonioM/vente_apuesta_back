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
        $user = $request->user();

        $montoDeposito = $request->input('monto');

        // ✅ Validar que el monto a depositar sea mayor o igual al último retiro
        if ($montoDeposito < $user->ultimo_retiro) {
            return response()->json([
                'success' => false,
                'message' => "El monto a depositar debe ser mayor o igual a tu último retiro ({$user->ultimo_retiro}).",
                'ultimo_retiro' => $user->ultimo_retiro,
                'monto_ingresado' => $montoDeposito
            ], 422); // 422 = Unprocessable Entity
        }

        $data = [
            'userId'          => $user->id,
            'tipo'            => 'DEPOSITO',
            'monto'           => $montoDeposito,
            'metodo_pago'     => $request->input('metodo_pago'),
            'referencia'      => $request->input('referencia'),
            'observacion'     => $request->input('observacion'),
            'flag_transaccion' => 1,
        ];

        // Crear transacción
        $transaccion = $this->transaccionService->crearTransaccion($data);

        // ✅ Resetear monto y actualizar menú
        $user->update([
            'ultimo_retiro' => 0, // 👈 monto reseteado
            'menu_actual'   => 1, // 👈 compra
        ]);

        return response()->json([
            'message'     => 'Depósito exitoso',
            'transaccion' => $transaccion,
            'user'        => $user,
        ], 201);
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
            $user->update([
                'flag_puede_retirar' => 0,
                'menu_actual'        => 4, // 👈 retiro completado
                'ultimo_retiro'      => $request->input('monto'), // 👈 guardamos monto
            ]);

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
