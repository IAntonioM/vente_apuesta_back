<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccions';

    protected $fillable = [
        'solicitudId',
        'tipo',
        'monto',
        'estado',
        'flag_transaccion',
        'referencia',
        'observacion',
        'metodo_pago',
        'userId',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'flag_transaccion' => 'integer'  // Cast para asegurar que sea entero
    ];

    public function usuario()
    {
        return $this->belongsTo(Userss::class, 'userId');
    }
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitudId');
    }
}
