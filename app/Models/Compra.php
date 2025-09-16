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
        'monto_compra',   // 👈 nuevo
        'monto_ganancia', // 👈 nuevo
        'monto_venta',    // 👈 nuevo
    ];


    protected $casts = [
        'fecha' => 'datetime',
    ];
}
