<?php

namespace App\Services;

use App\Models\UserJuego;
use App\Models\User;
use App\Models\Juego;

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
            $userJuego->nivel_actual = $data['nivel_actual'];
            $userJuego->ronda_actual = $data['ronda_actual'] ?? $userJuego->ronda_actual; // 👈 si no viene, conserva el valor
            $userJuego->save();
        } else {
            $userJuego = UserJuego::create([
                'user_id'      => $data['user_id'],
                'juego_id'     => $data['juego_id'],
                'nivel_actual' => $data['nivel_actual'],
                'ronda_actual' => $data['ronda_actual'] ?? 1, // 👈 si no envías nada, arranca en 1
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
}
