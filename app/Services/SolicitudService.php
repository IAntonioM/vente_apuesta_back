<?php

namespace App\Services;

use App\Models\Solicitud;

class SolicitudService
{
    /**
     * Listar solicitudes de un usuario autenticado
     */
    public function listarPorUsuario(int $userId, int $perPage = 7, int $page = 1)
    {
        return Solicitud::where('user_id', $userId)
            ->with('estado')
            ->with('tipo')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
        // 🔹 forzamos a usar page y per_page enviados
    }


    /**
     * Crear una solicitud (por ejemplo, cuando se hace un retiro)
     */
    public function crearSolicitud(array $data)
    {
        return Solicitud::create([
            'user_id'          => $data['user_id'],
            'tipo_solicitud'   => $data['tipo_solicitud'],
            'estado_solicitud' => $data['estado_solicitud'],
            'descripcion'      => $data['descripcion'] ?? null,
            'motivo_rechazo'   => $data['motivo_rechazo'] ?? null,
            'monto'            => $data['monto'],
        ]);
    }
}
