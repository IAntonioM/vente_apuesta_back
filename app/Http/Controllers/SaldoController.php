<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Services\SaldoService;
use Illuminate\Http\Request;
use Exception;

class SaldoController extends Controller
{
    protected $saldoService;

    public function __construct(SaldoService $saldoService)
    {
        $this->saldoService = $saldoService;
    }

    public function obtenerSaldo(Request $request)
    {
        try {
            $userId = $request->user()->id;

            // Obtener saldo
            $saldo = $this->saldoService->getSaldoByUser($userId);

            // Obtener última solicitud de retiro del usuario
            $ultimaSolicitudRetiro = Solicitud::where('user_id', $userId)
                ->where('tipo_solicitud', 1) // 1 = RETIRO
                ->orderBy('created_at', 'desc')
                ->first();

            return response()->json([
                'saldo' => (float) ($saldo->saldo ?? 0),
                'numero_cuenta' => $ultimaSolicitudRetiro->numero_cuenta ?? '',
                'banco' => $ultimaSolicitudRetiro->banco_id ?? '',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener saldo'], 500);
        }
    }
}
