<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccions';

    protected $fillable = [
        'userId',
        'tipo',
        'monto',
        'estado',
        'metodo_pago',
        'referencia',
        'observacion',
        'flag_transaccion'  // Campo agregado
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'flag_transaccion' => 'integer'  // Cast para asegurar que sea entero
    ];

    public function usuario()
    {
        return $this->belongsTo(Userss::class, 'userId');
    }
}
