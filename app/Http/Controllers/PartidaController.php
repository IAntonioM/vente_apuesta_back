<?php

namespace App\Http\Controllers;

use App\Services\PartidaService;
use Illuminate\Http\Request;
use Exception;

class PartidaController extends Controller
{
    protected $partidaService;

    public function __construct(PartidaService $partidaService)
    {
        $this->partidaService = $partidaService;
    }

    public function jugar(Request $request)
    {
        try {
            $data = $this->partidaService->crearPartida([
                'userId'        => $request->user()->id,
                'juegoId'       => $request->input('juegoId'),
                'nivelJuegoId'  => $request->input('nivelJuegoId'),
                'monto_apostado'=> $request->input('monto_apostado')
            ]);

            return response()->json([
                'message' => 'Partida iniciada',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function finalizar(Request $request, $partidaId)
    {
        try {
            $data = $this->partidaService->finalizarPartida([
                'partidaId' => $partidaId,
                'resultado' => $request->input('resultado')
            ]);

            return response()->json([
                'message' => 'Partida finalizada',
                'partida' => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
