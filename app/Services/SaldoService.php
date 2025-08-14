<?php

namespace App\Services;

use App\Models\SaldoUsuario;

class SaldoService
{
    public function getSaldoByUser(int $userId)
    {
        // Busca el saldo existente del usuario
        $saldo = SaldoUsuario::where('userId', $userId)->first();

        return $saldo; // Puede ser null si no existe
    }
}
