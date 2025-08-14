<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'userId',
        'ventaId',
        'transaccionId',
        'cantidad',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}
