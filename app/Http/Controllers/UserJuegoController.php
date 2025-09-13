<?php

namespace App\Http\Controllers;

use App\Models\NivelJuego;
use App\Services\TransaccionService;
use App\Services\UserJuegoService;
use Illuminate\Http\Request;
use Exception;

class UserJuegoController extends Controller
{
    protected $userJuegoService;
    protected $transaccionService;

    public function __construct(UserJuegoService $userJuegoService, TransaccionService $transaccionService)
    {
        $this->userJuegoService = $userJuegoService;
        $this->transaccionService = $transaccionService;
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
                'juego_id'       => 'required|integer',
                'nivel_actual'   => 'required|integer',
                'ronda_actual'   => 'required|integer', // 👈 validamos la ronda
                'tipo'           => 'required|integer|in:0,1',   // 0 = perdió, 1 = ganó
                'monto'          => 'required|integer|min:0',
                'referencia'     => 'nullable|string',
                'observacion'    => 'nullable|string',
            ]);

            // 🔹 Validar si existe ese nivel y ronda en la tabla nivelesjuego
            $nivelValido = NivelJuego::where('juegoId', $request->input('juego_id'))
                ->where('nivel', $request->input('nivel_actual'))
                ->where('ronda', $request->input('ronda_actual'))
                ->first();

            if (!$nivelValido) {
                return response()->json([
                    'success' => false,
                    'message' => 'El nivel y la ronda no existen para este juego'
                ], 422);
            }

            $userJuego = $this->userJuegoService->crearOActualizarNivel([
                'user_id'      => $request->user()->id,
                'juego_id'     => $request->input('juego_id'),
                'nivel_actual' => $request->input('nivel_actual'),
                'ronda_actual' => $request->input('ronda_actual'), // 👈 lo enviamos al service
            ]);

            $tipo = $request->input('tipo') == 1 ? 'DEPOSITO' : 'RETIRO';

            $data = [
                'userId'           => $request->user()->id,
                'tipo'             => $tipo, // Aquí ya va como texto
                'monto'            => $request->input('monto'),
                'metodo_pago'      => '',
                'referencia'       => $request->input('referencia'),
                'observacion'      => $request->input('observacion'),
                'flag_transaccion' => 0
            ];
            $this->transaccionService->crearTransaccion($data);

            // 🔹 Validar flags del usuario
            $user = $request->user();

            if ($request->input('tipo') == 1 && $user->flag_ronda_1 == 1 && $user->flag_puede_retirar == 0) {
                $user->update([
                    'flag_ronda_1'      => 0,
                    'flag_puede_retirar' => 1,
                ]);
            }

            return response()->json([
                'success' => true,
                'userJuego' => $userJuego,
                'user' => $user
            ], 201);
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
