<?php

namespace App\Http\Controllers;

use App\Services\JuegoService;
use Illuminate\Http\Request;
use Exception;

class JuegoController extends Controller
{
    protected $juegoService;

    public function __construct(JuegoService $juegoService)
    {
        $this->juegoService = $juegoService;
    }

    public function listarJuegos(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $juegos = $this->juegoService->getAllJuegosActivos($userId);
            return response()->json($juegos);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al listar juegos'], 500);
        }
    }

    public function listarNivelesPorJuego($juegoId)
    {
        try {
            $niveles = $this->juegoService->getNivelesPorJuego($juegoId);
            return response()->json($niveles);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener niveles del juego'], 500);
        }
    }
}
