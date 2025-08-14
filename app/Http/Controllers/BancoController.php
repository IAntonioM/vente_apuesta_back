<?php

namespace App\Http\Controllers;

use App\Services\BancoService;
use Exception;

class BancoController extends Controller
{
    protected $bancoService;

    public function __construct(BancoService $bancoService)
    {
        $this->bancoService = $bancoService;
    }

    public function getBancosActivos()
    {
        try {
            $bancos = $this->bancoService->getAllActivos();
            return response()->json($bancos);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al obtener bancos',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
