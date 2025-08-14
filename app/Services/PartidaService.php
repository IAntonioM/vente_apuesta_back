<?php

namespace App\Services;

use App\Models\Partida;
use App\Models\SaldoUsuario;
use App\Models\NivelJuego;
use Illuminate\Support\Facades\DB;
use Exception;

class PartidaService
{
    public function crearPartida(array $data)
    {
        $userId         = $data['userId'];
        $juegoId        = $data['juegoId'];
        $nivelJuegoId   = $data['nivelJuegoId'];
        $montoApostado  = $data['monto_apostado'];

        $saldo = SaldoUsuario::where('user_id', $userId)->first();
        if (!$saldo || floatval($saldo->saldo) < $montoApostado) {
            throw new Exception('Saldo insuficiente');
        }

        $nivel = NivelJuego::find($nivelJuegoId);
        if (!$nivel) {
            throw new Exception('Nivel de juego no encontrado');
        }

        DB::beginTransaction();

        try {
            // Descontar saldo
            $saldo->saldo -= $montoApostado;
            $saldo->save();

            // Crear partida
            $partida = Partida::create([
                'user_id'       => $userId,
                'juego_id'      => $juegoId,
                'nivel_juego_id'=> $nivelJuegoId,
                'monto_apostado'=> $montoApostado,
                'resultado'     => 'PENDIENTE'
            ]);

            DB::commit();

            return [
                'partida' => $partida,
                'tiempo'  => $nivel->tiempo
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function finalizarPartida(array $data)
    {
        $partidaId = $data['partidaId'];
        $resultado = $data['resultado'];

        $partida = Partida::find($partidaId);
        if (!$partida) {
            throw new Exception('Partida no encontrada');
        }
        if ($partida->resultado !== 'PENDIENTE') {
            throw new Exception('Partida ya finalizada');
        }

        $nivel = NivelJuego::find($partida->nivel_juego_id);
        $saldo = SaldoUsuario::where('user_id', $partida->user_id)->first();

        DB::beginTransaction();

        try {
            $partida->resultado = $resultado;
            $partida->tiempo_fin = now();

            if ($resultado === 'GANADO') {
                $ganancia = floatval($partida->monto_apostado) * floatval($nivel->multiplicador);
                $partida->ganancia = $ganancia;

                $saldo->saldo += $ganancia;
                $saldo->save();
            }

            $partida->save();
            DB::commit();

            return $partida;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
