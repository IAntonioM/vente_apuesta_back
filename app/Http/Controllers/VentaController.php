<?php

namespace App\Http\Controllers;

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

    public function getVentas()
    {
        try {
            $ventas = $this->ventaService->getAllVentas();
            return response()->json($ventas);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener ventas', 'error' => $e->getMessage()], 500);
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
