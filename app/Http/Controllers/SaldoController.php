<?php

namespace App\Http\Controllers;

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
            $saldo = $this->saldoService->getSaldoByUser($request->user()->id);
            return response()->json(['saldo' => (float) $saldo->saldo]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener saldo'], 500);
        }
    }
}
