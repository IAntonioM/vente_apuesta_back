<?php

namespace App\Services;

use App\Models\Juego;
use App\Models\UserJuego;
use App\Models\NivelJuego;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class JuegoService
{
public function getAllJuegosActivos(int $userId)
{
    try {
        $juegos = DB::table('juegos')
            ->leftJoin('userjuegos', function ($join) use ($userId) {
                $join->on('juegos.id', '=', 'userjuegos.juego_id')
                     ->where('userjuegos.user_id', '=', $userId);
            })
            ->where('juegos.estado', true)
            ->select(
                'juegos.id',
                'juegos.nombre',
                'juegos.descripcion',
                'juegos.estado',
                'juegos.createdAt as created_at',
                DB::raw('COALESCE(userjuegos.nivel_actual, 1) as nivel_actual'),
                DB::raw('COALESCE(userjuegos.ronda_actual, 1) as ronda_actual') // 👈 agregado
            )
            ->orderBy('juegos.nombre', 'ASC')
            ->get();

        return $juegos;

    } catch (Exception $e) {
        Log::error('Error en getAllJuegosActivos: ' . $e->getMessage());
        throw $e;
    }
}

    public function getNivelesPorJuego(int $juegoId)
    {
        return NivelJuego::where('juegoId', $juegoId)
            ->where('estado', true)
            ->orderBy('nivel', 'ASC')
            ->get();
    }
}
