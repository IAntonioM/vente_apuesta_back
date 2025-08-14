<?php

namespace App\Services;

use App\Models\Banco;

class BancoService
{
    public function getAllActivos()
    {
        return Banco::where('estado', true)
            ->orderBy('nombre', 'ASC')
            ->get();
    }
}
