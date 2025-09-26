<?php

namespace App\Services;

use App\Models\UserJuego;
use App\Models\User;
use App\Models\Juego;
use App\Models\NivelJuego;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class UserJuegoService
{
    public function getNivelUsuarioEnJuego(int $userId, int $juegoId)
    {
        return UserJuego::with([
            'usuario:id,nombres_apellidos,correo',
            'juego:id,nombre'
        ])
            ->where('user_id', $userId)
            ->where('juego_id', $juegoId)
            ->first();
    }

    public function crearOActualizarNivel(array $data)
    {
        $userJuego = UserJuego::where('user_id', $data['user_id'])
            ->where('juego_id', $data['juego_id'])
            ->first();

        if ($userJuego) {
            // 🔹 Actualizar registro existente
            $userJuego->nivel_actual = $data['nivel_actual'];
            $userJuego->ronda_actual = $data['ronda_actual'] ?? $userJuego->ronda_actual;

            // 🔹 Solo actualizar f_ronda_update si viene en los datos
            if (isset($data['f_ronda_update'])) {
                $userJuego->f_ronda_update = $data['f_ronda_update'];
            }

            $userJuego->save();
        } else {
            // 🔹 Crear nuevo registro
            $userJuego = UserJuego::create([
                'user_id'        => $data['user_id'],
                'juego_id'       => $data['juego_id'],
                'nivel_actual'   => $data['nivel_actual'],
                'ronda_actual'   => $data['ronda_actual'] ?? 1,
                'f_ronda_update' => $data['f_ronda_update'] ?? now(), // 👈 Si no viene, usar fecha actual
            ]);
        }

        return $userJuego;
    }


    public function getTodosNivelesDeUsuario(int $userId)
    {
        return UserJuego::with(['juego:id,nombre'])
            ->where('user_id', $userId)
            ->get();
    }




    public function calcularTiempoRestante(int $userId, int $juegoId = 1)
    {
        try {
            // 🔹 Obtener datos del usuario y su progreso actual
            $userJuego = UserJuego::where('user_id', $userId)
                ->where('juego_id', $juegoId)
                ->first();

            if (!$userJuego) {
                throw new Exception("No se encontró progreso del usuario en el juego");
            }

            // 🔹 Obtener configuración del nivel actual
            $nivelJuego = NivelJuego::where('juegoId', $juegoId)
                ->where('nivel', $userJuego->nivel_actual)
                ->where('ronda', $userJuego->ronda_actual)
                ->where('estado', true)
                ->first();

            if (!$nivelJuego) {
                throw new Exception("No se encontró configuración para el nivel actual");
            }

            // 🔹 Obtener tiempo de recarga de la ronda (en horas)
            $tiempoRecargaHoras = $nivelJuego->t_ronda_recarga;

            // 🔹 Si no hay f_ronda_update, usar created_at del userJuego
            $fechaInicio = $userJuego->f_ronda_update ?? $userJuego->created_at;

            if (!$fechaInicio) {
                throw new Exception("No se pudo determinar la fecha de inicio");
            }

            // 🔹 Calcular tiempo transcurrido y restante
            $ahora = now();
            $fechaFinRecarga = Carbon::parse($fechaInicio)->addHours($tiempoRecargaHoras);

            // 🔹 Verificar si ya pasó el tiempo de recarga
            if ($ahora >= $fechaFinRecarga) {
                return [
                    'tiempo_agotado' => true,
                    'tiempo_restante' => [
                        'horas' => 0,
                        'minutos' => 0,
                        'segundos' => 0,
                        'total_segundos' => 0
                    ],
                ];
            }

            // 🔹 Calcular tiempo restante
            $segundosRestantes = $ahora->diffInSeconds($fechaFinRecarga);
            $horasRestantes = floor($segundosRestantes / 3600);
            $minutosRestantes = floor(($segundosRestantes % 3600) / 60);
            $segundosRestantesFinal = $segundosRestantes % 60;

            return [
                'tiempo_agotado' => false,
                'tiempo_restante' => [
                    'horas' => $horasRestantes,
                    'minutos' => $minutosRestantes,
                    'segundos' => $segundosRestantesFinal,
                    'total_segundos' => $segundosRestantes
                ],
                'mensaje' => "Tiempo restante: {$horasRestantes}h {$minutosRestantes}m {$segundosRestantesFinal}s"
            ];
        } catch (Exception $e) {
            Log::error('Error en calcularTiempoRestante: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verificar si el usuario puede jugar (sin restricción de tiempo)
     */
    public function puedeJugar(int $userId, int $juegoId = 1): bool
    {
        try {
            $cronometro = $this->calcularTiempoRestante($userId, $juegoId);
            return $cronometro['puede_jugar'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtener solo el tiempo restante en formato string
     */
    public function getTiempoRestanteString(int $userId, int $juegoId = 1): string
    {
        try {
            $cronometro = $this->calcularTiempoRestante($userId, $juegoId);

            if ($cronometro['tiempo_agotado']) {
                return "00:00:00";
            }

            $tiempo = $cronometro['tiempo_restante'];
            return sprintf(
                "%02d:%02d:%02d",
                $tiempo['horas'],
                $tiempo['minutos'],
                $tiempo['segundos']
            );
        } catch (Exception $e) {
            return "Error";
        }
    }

    public function actualizarSoloTiempo(array $data)
    {
        $userJuego = UserJuego::where('user_id', $data['user_id'])
            ->where('juego_id', $data['juego_id'])
            ->first();

        if ($userJuego && isset($data['f_ronda_update'])) {
            $userJuego->f_ronda_update = $data['f_ronda_update'];
            $userJuego->save();
            return $userJuego;
        }

        return null;
    }
}
