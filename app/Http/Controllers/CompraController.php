<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use Illuminate\Http\Request;
use Exception;

class CompraController extends Controller
{
    protected $compraService;

    public function __construct(CompraService $compraService)
    {
        $this->compraService = $compraService;
    }

    public function crearCompra(Request $request)
    {
        try {
            $compra = $this->compraService->crearCompra([
                'userId'   => $request->user()->id,
                'ventaId'  => $request->input('ventaId'),
                'cantidad' => $request->input('cantidad')
            ]);

            $user = $request->user();
            $user->menu_actual = 2; // juego
            $user->estado_partida_comodin = 0; // juego
            $user->save();

            return response()->json([
                'compra' => $compra,
                'user'   => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Error al registrar compra'
            ], 400);
        }
    }


    public function misCompras(Request $request)
    {
        try {
            $compras = $this->compraService->getComprasPorUsuario($request->user()->id);
            return response()->json($compras);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al obtener compras'
            ], 500);
        }
    }
}
