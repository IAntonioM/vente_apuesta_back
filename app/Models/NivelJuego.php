<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelJuego extends Model
{
    public $timestamps = false;
    protected $table = 'nivelesjuego';

    protected $fillable = [
        'juegoId',
        'nivel',
        'multiplicador',
        'tiempo',
        'estado',
        'createdAt',
        'ronda'   // nuevo campo
    ];

    protected $casts = [
        'estado' => 'boolean',
        'multiplicador' => 'decimal:2',
        'createdAt' => 'datetime',
        'ronda' => 'integer', // casteo para que siempre sea int en PHP
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juegoId');
    }
}

