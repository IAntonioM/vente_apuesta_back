<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    public $timestamps = false;
    protected $table = 'partidas';

    protected $fillable = [
        'userId',
        'juegoId',
        'nivelJuegoId',
        'monto_apostado',
        'resultado',
        'ganancia',
        'tiempo_inicio',
        'tiempo_fin',
        'createdAt'
    ];

    protected $casts = [
        'monto_apostado' => 'decimal:2',
        'ganancia' => 'decimal:2',
        'tiempo_inicio' => 'datetime',
        'tiempo_fin' => 'datetime',
        'createdAt' => 'datetime',
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juegoId');
    }

    public function nivel()
    {
        return $this->belongsTo(NivelJuego::class, 'nivelJuegoId');
    }
}
