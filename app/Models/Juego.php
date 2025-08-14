<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'createdAt'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'createdAt' => 'datetime',
    ];

    public function niveles()
    {
        return $this->hasMany(NivelJuego::class, 'juegoId');
    }

}
