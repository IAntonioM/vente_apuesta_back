<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJuego extends Model
{
    protected $table = 'userjuegos';

    protected $fillable = [
        'user_id',
        'juego_id',
        'nivel_actual',
        'ronda_actual', // 👈 agrega esto
    ];

    public function usuario()
    {
        return $this->belongsTo(Userss::class, 'user_id');
    }

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }
}
