<?php

namespace App\Http\Controllers;

use App\Services\SolicitudService;
use Illuminate\Http\Request;
use Exception;

class SolicitudController extends Controller
{
    protected $solicitudService;

    public function __construct(SolicitudService $solicitudService)
    {
        $this->solicitudService = $solicitudService;
    }

    /**
     * Listar solicitudes por usuario autenticado
     */
    public function listarPorUsuario(Request $request)
    {
        try {
            $userId   = $request->user()->id;

            $page     = $request->input('page', 1);
            $perPage  = $request->input('per_page', 7);

            $solicitudes = $this->solicitudService->listarPorUsuario($userId, $perPage, $page);

            // 🔹 Mapear y agregar número de orden global
            $start = ($solicitudes->currentPage() - 1) * $solicitudes->perPage();
            $data = $solicitudes->items();
            foreach ($data as $index => $item) {
                $item->n_solicitud = $start + $index + 1;
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'pagination' => [
                    'current_page' => $solicitudes->currentPage(),
                    'per_page'     => $solicitudes->perPage(),
                    'total'        => $solicitudes->total(),
                    'last_page'    => $solicitudes->lastPage(),
                    'next_page_url' => $solicitudes->nextPageUrl(),
                    'prev_page_url' => $solicitudes->previousPageUrl(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las solicitudes',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
