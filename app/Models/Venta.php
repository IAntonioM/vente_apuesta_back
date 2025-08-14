<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{    protected $table = 'venta';
    protected $fillable = [
        'nombre',
        'precio',
        'img_url',
        'cantidad'
    ];

    protected $casts = [
        'precio' => 'decimal:2'
    ];
}
