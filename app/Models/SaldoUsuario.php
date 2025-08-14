<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoUsuario extends Model
{
    protected $table = 'saldousuarios';
    public $timestamps = false;

    protected $fillable = [
        'userId',
        'saldo'
    ];

    protected $casts = [
        'saldo' => 'decimal:2'
    ];

    public function usuario()
    {
        return $this->belongsTo(Userss::class, 'userId');
    }
}
