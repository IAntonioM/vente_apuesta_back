<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
class Userss extends Authenticatable
{
    use HasApiTokens; // Agregar este trait

    protected $table = 'userss';

    protected $fillable = [
        'nombres_apellidos',
        'correo',
        'nro_cuenta',
        'cel',
        'password',
        'rol',
        'bancoId',
        'flag_ronda_1',       // nuevo campo
        'flag_puede_retirar'  // nuevo campo
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'flag_ronda_1' => 'boolean',
        'flag_puede_retirar' => 'boolean',
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'bancoId');
    }

    public function saldoUsuario()
    {
        return $this->hasOne(SaldoUsuario::class, 'userId');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'userId');
    }
}
