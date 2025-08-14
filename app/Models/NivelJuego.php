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
        'createdAt'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'multiplicador' => 'decimal:2',
        'createdAt' => 'datetime',
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juegoId');
    }
}
