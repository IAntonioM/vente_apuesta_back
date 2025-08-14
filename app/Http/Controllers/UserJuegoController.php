<?php

namespace App\Http\Controllers;

use App\Services\UserJuegoService;
use Illuminate\Http\Request;
use Exception;

class UserJuegoController extends Controller
{
    protected $userJuegoService;

    public function __construct(UserJuegoService $userJuegoService)
    {
        $this->userJuegoService = $userJuegoService;
    }

    public function obtenerNivel(Request $request, $juegoId)
    {
        try {
            $nivel = $this->userJuegoService->getNivelUsuarioEnJuego($request->user()->id, $juegoId);

            if (!$nivel) {
                return response()->json(['message' => 'No se encontró nivel para este juego'], 404);
            }

            return response()->json($nivel);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al obtener nivel'], 500);
        }
    }

    public function guardarNivel(Request $request)
    {
        try {
            $request->validate([
                'juego_id'      => 'required|integer',
                'nivel_actual'  => 'required|integer'
            ]);

            $userJuego = $this->userJuegoService->crearOActualizarNivel([
                'user_id'       => $request->user()->id,
                'juego_id'      => $request->input('juego_id'),
                'nivel_actual'  => $request->input('nivel_actual')
            ]);

            return response()->json($userJuego, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al guardar nivel'], 500);
        }
    }

    public function listarNivelesUsuario(Request $request)
    {
        try {
            $niveles = $this->userJuegoService->getTodosNivelesDeUsuario($request->user()->id);
            return response()->json($niveles);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al obtener niveles'], 500);
        }
    }
}
