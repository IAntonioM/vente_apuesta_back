<?php

namespace App\Http\Controllers;

use App\Models\Compra;
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
                'ronda_actual'   => 'required|integer',
                'tipo'           => 'required|integer|in:0,1',   // 0 = perdió, 1 = ganó
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

            // 🔹 Verificar si es una partida "todo o nada"
            $esTodoONada = $nivelValido->flag_todo_o_nada == 1;

            // 🔹 Obtener la ronda actual antes del cambio para comparar
            $rondaAnterior = $request->input('ronda_actual');

            // 🔹 Determinar el nivel y ronda destino
            $nivelDestino = $request->input('nivel_actual');
            $rondaDestino = $request->input('ronda_actual');
            $cambioDeRonda = false; // 👈 Flag para saber si hubo cambio de ronda

            if ($request->input('tipo') == 1 || $esTodoONada) {
                // 👈 Si GANÓ O es TODO O NADA - buscar el siguiente nivel/ronda
                $siguienteNivel = NivelJuego::where('juegoId', $request->input('juego_id'))
                    ->where(function ($query) use ($request) {
                        $query->where('ronda', '>', $request->input('ronda_actual'))
                            ->orWhere(function ($subQuery) use ($request) {
                                $subQuery->where('ronda', '=', $request->input('ronda_actual'))
                                    ->where('nivel', '>', $request->input('nivel_actual'));
                            });
                    })
                    ->orderBy('ronda', 'ASC')
                    ->orderBy('nivel', 'ASC')
                    ->first();

                if ($siguienteNivel) {
                    // HAY siguiente nivel/ronda - avanzar
                    $nivelDestino = $siguienteNivel->nivel;
                    $rondaDestino = $siguienteNivel->ronda;

                    // 🔹 Verificar si cambió de ronda
                    if ($rondaDestino > $rondaAnterior) {
                        $cambioDeRonda = true;
                    }
                }
                // Si NO hay siguiente, se queda en el mismo lugar
            }
            // Si perdió en partida normal (tipo = 0 && !esTodoONada), se queda en el nivel/ronda actual

            // 🔹 Preparar datos para actualizar el progreso del usuario
            $datosActualizacion = [
                'user_id'      => $request->user()->id,
                'juego_id'     => $request->input('juego_id'),
                'nivel_actual' => $nivelDestino,  // 👈 Nivel destino
                'ronda_actual' => $rondaDestino,  // 👈 Ronda destino
            ];

            // 🔹 Solo agregar f_ronda_update si hubo cambio de ronda
            if ($cambioDeRonda) {
                $datosActualizacion['f_ronda_update'] = now(); // 👈 Actualizar fecha solo si cambió de ronda
            }

            // 🔹 Actualizar el progreso del usuario con el nivel/ronda destino
            $userJuego = $this->userJuegoService->crearOActualizarNivel($datosActualizacion);

            // 🔹 Obtener la última compra para usar su monto
            $ultimaCompra = Compra::where('userId', $request->user()->id)
                ->latest('id')
                ->first();

            if (!$ultimaCompra) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró una compra para procesar'
                ], 422);
            }

            $tipo = $request->input('tipo') == 1 ? 'DEPOSITO' : 'RETIRO';

            // 🔹 Usar el monto correcto según ganó o perdió
            $monto = $request->input('tipo') == 1
                ? $ultimaCompra->monto_ganancia  // Si ganó, usar ganancia
                : $ultimaCompra->monto_compra;   // Si perdió, usar monto de compra

            $data = [
                'userId'           => $request->user()->id,
                'tipo'             => $tipo,
                'monto'            => $monto, // 👈 Ahora usa el monto correcto
                'metodo_pago'      => '',
                'referencia'       => $request->input('referencia'),
                'observacion'      => $request->input('observacion'),
                'flag_transaccion' => 0
            ];

            // 🔹 El servicio ya maneja el saldo, no lo hacemos aquí
            $this->transaccionService->crearTransaccion($data);

            // 🔹 Solo actualizar flags del usuario, NO el saldo
            $user = $request->user();

            // 🔹 Actualizar estado_partida_comodin si es todo o nada
            if ($esTodoONada) {
                if ($request->input('tipo') == 1) {
                    // 👈 Ganó partida todo o nada
                    $user->estado_partida_comodin = 2; // gano_partida

                    // Si ganó en todo o nada, siempre va a retiro
                    if ($user->flag_ronda_1 == 1 && $user->flag_puede_retirar == 0) {
                        $user->update([
                            'flag_ronda_1'       => 0,
                            'flag_puede_retirar' => 1,
                            'menu_actual'        => 3, // retiro
                            'estado_partida_comodin' => $user->estado_partida_comodin,
                        ]);
                    } else {
                        $user->update([
                            'menu_actual' => 3, // retiro
                            'estado_partida_comodin' => $user->estado_partida_comodin,
                        ]);
                    }
                } else {
                    // 👈 Perdió partida todo o nada - pierde derecho a retirar
                    $user->update([
                        'menu_actual' => 1, // vuelve al inicio (pierde derecho)
                        'estado_partida_comodin' => 1, // perdio_partida
                    ]);
                }
            } else {
                // 👈 No es todo o nada - lógica normal
                $user->estado_partida_comodin = 0; // no_tiene_restricciones

                if ($request->input('tipo') == 1) {
                    // 👈 Si ganó - verificar si está en el último nivel de la ronda actual
                    $ultimoNivelRonda = NivelJuego::where('juegoId', $request->input('juego_id'))
                        ->where('ronda', $request->input('ronda_actual'))
                        ->max('nivel');

                    $estaEnUltimoNivel = ($request->input('nivel_actual') == $ultimoNivelRonda);

                    if ($estaEnUltimoNivel) {
                        // 👈 Está en el último nivel de la ronda - puede retirar
                        if ($user->flag_ronda_1 == 1 && $user->flag_puede_retirar == 0) {
                            $user->update([
                                'flag_ronda_1'       => 0,
                                'flag_puede_retirar' => 1,
                                'menu_actual'        => 3, // retiro
                                'estado_partida_comodin' => $user->estado_partida_comodin,
                            ]);
                        } else {
                            $user->update([
                                'menu_actual' => 3, // retiro
                                'estado_partida_comodin' => $user->estado_partida_comodin,
                            ]);
                        }
                    } else {
                        // 👈 NO está en el último nivel - sigue jugando
                        $user->update([
                            'menu_actual' => 1, // sigue jugando
                            'estado_partida_comodin' => $user->estado_partida_comodin,
                        ]);
                    }
                } else {
                    // 👈 Si perdió en partida normal
                    $user->update([
                        'menu_actual' => 1, // vuelve al inicio
                        'estado_partida_comodin' => $user->estado_partida_comodin,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'userJuego' => $userJuego,
                'user' => $user,
                'nivel_anterior' => [
                    'nivel' => $request->input('nivel_actual'),
                    'ronda' => $request->input('ronda_actual')
                ],
                'nivel_destino' => [
                    'nivel' => $nivelDestino,
                    'ronda' => $rondaDestino
                ],
                'es_todo_o_nada' => $esTodoONada,
                'estado_partida_comodin' => $user->estado_partida_comodin,
                'cambio_de_ronda' => $cambioDeRonda // 👈 Información adicional para debugging
            ], 201);
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


    public function obtenerTiempoRestante(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $juegoId = $request->input('juego_id', 1); // Por defecto juego 1

            $cronometro = $this->userJuegoService->calcularTiempoRestante($userId, $juegoId);

            return response()->json([
                'success' => true,
                'cronometro' => $cronometro
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?? 'Error al obtener cronómetro'
            ], 500);
        }
    }
}
