<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';

    protected $fillable = [
        'nombre',
        'precio',
        'img_url',
        'cantidad',
        'n_ronda',      // nuevo campo
        'flag_mayor'    // nuevo campo
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'flag_mayor' => 'boolean', // lo manejas como true/false en PHP
    ];
}
