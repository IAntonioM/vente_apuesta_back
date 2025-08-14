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
        'observacion'
    ];

    protected $casts = [
        'monto' => 'decimal:2'
    ];

    public function usuario()
    {
        return $this->belongsTo(Userss::class, 'userId');
    }
}
