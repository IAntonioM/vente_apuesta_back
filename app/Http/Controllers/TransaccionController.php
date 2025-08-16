<?php

namespace App\Http\Controllers;

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
                'trag_transaccion' => 1,
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
            $data = [
                'userId'      => $request->user()->id,
                'tipo'        => 'RETIRO',
                'monto'       => $request->input('monto'),
                'metodo_pago' => $request->input('metodo_pago'),
                'observacion' => $request->input('observacion'),
                'trag_transaccion' => 1,
                'referencia'  => $request->input('referencia'),
            ];

            $transaccion = $this->transaccionService->crearTransaccion($data);
            return response()->json($transaccion, 201);
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
