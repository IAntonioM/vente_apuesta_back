<?php

namespace App\Http\Controllers;

use App\Models\UserJuego;
use App\Services\VentaService;
use Illuminate\Http\Request;
use Exception;

class VentaController extends Controller
{
    protected $ventaService;

    public function __construct(VentaService $ventaService)
    {
        $this->ventaService = $ventaService;
    }

    public function crearVenta(Request $request)
    {
        try {
            $venta = $this->ventaService->crearVenta($request->all());
            return response()->json($venta, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al crear venta'], 400);
        }
    }

public function getVentas(Request $request)
{
    try {
        $user = auth()->user();

        // progreso del usuario en el juego con id=1
        $userJuego = UserJuego::where('user_id', $user->id)
            ->where('juego_id', 1)
            ->first();

        // Si no tiene progreso todavía, asumimos ronda_actual = 1 y nivel_actual = 1
        $rondaActual = $userJuego ? $userJuego->ronda_actual : 1;
        $nivelActual = $userJuego ? $userJuego->nivel_actual : 1;

        // filtrar ventas por ronda y nivel actual
        $ventas = $this->ventaService->getVentasByRondaYNivel($rondaActual, $nivelActual);

        return response()->json([
            'ronda_actual' => $rondaActual,
            'nivel_actual' => $nivelActual,
            'ventas' => $ventas
        ]);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'Error al obtener ventas',
            'error' => $e->getMessage()
        ], 500);
    }
}



    public function getVenta($id)
    {
        try {
            $venta = $this->ventaService->getVentaById($id);
            return response()->json($venta);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
