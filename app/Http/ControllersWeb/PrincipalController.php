<?php

namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Userss;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrincipalController extends Controller
{
    public function index(Request $request)
    {
        // Incluir la relación con solicitud
        $query = Transaccion::with(['usuario', 'usuario.banco', 'solicitud', 'solicitud.tipo', 'solicitud.estado']);

        // Filtro por tipo de transacción
        if ($request->filled('tipo') && $request->tipo !== 'TODOS') {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por búsqueda (nombre de usuario, referencia, método de pago)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('usuario', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('nombres_apellidos', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('correo', 'LIKE', "%{$searchTerm}%");
                })
                    ->orWhere('referencia', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('metodo_pago', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('monto', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtro por flag_transaccion
        if ($request->filled('flag_transaccion')) {
            $query->where('flag_transaccion', $request->flag_transaccion);
        }

        // Filtro por estado
        if ($request->filled('estado') && $request->estado !== 'TODOS') {
            $query->where('estado', $request->estado);
        }

        // Filtro por estado de solicitud
        if ($request->filled('estado_solicitud') && $request->estado_solicitud !== 'TODOS') {
            $query->whereHas('solicitud', function ($q) use ($request) {
                $q->where('estado_solicitud', $request->estado_solicitud);
            });
        }

        // Filtro por fecha desde
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        // Filtro por fecha hasta
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        // Ordenar por fecha más reciente
        $query->orderBy('created_at', 'desc');

        // Paginación
        $transacciones = $query->paginate(15)->withQueryString();
            Log::info("Query SQL generado:", [
        'data' => $transacciones
    ]);
        // Estadísticas básicas
        $statsQuery = Transaccion::query();

        // Aplicar filtros de fecha a las estadísticas también
        if ($request->filled('fecha_desde')) {
            $statsQuery->whereDate('created_at', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $statsQuery->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        $totalDepositos = (clone $statsQuery)
            ->where('tipo', 'DEPOSITO')
            ->where('estado', 'APROBADO')
            ->sum('monto');

        $totalRetiros = (clone $statsQuery)
            ->where('tipo', 'RETIRO')
            ->where('estado', 'APROBADO')
            ->sum('monto');

        $totalTransacciones = $query->count();

        return view('admin.principal', compact(
            'transacciones',
            'totalDepositos',
            'totalRetiros',
            'totalTransacciones'
        ));
    }

    /**
     * Actualizar estado de solicitud
     */
    public function actualizarSolicitud(Request $request, $id)
    {
        $request->validate([
            'estado_solicitud' => 'required|in:1,2,3,4', // 1=Pendiente, 2=Aprobada, 3=Rechazada, 4=En Proceso
            'motivo_rechazo' => 'required_if:estado_solicitud,3|nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            $solicitud = Solicitud::findOrFail($id);

            // Actualizar la solicitud
            $solicitud->estado_solicitud = $request->estado_solicitud;

            if ($request->estado_solicitud == 3) { // Si es rechazada
                $solicitud->motivo_rechazo = $request->motivo_rechazo;
            } else {
                $solicitud->motivo_rechazo = null;
            }

            $solicitud->save();

            // Si la solicitud tiene una transacción asociada, actualizar su estado también
            if ($solicitud->transaccion) {
                $transaccion = $solicitud->transaccion;

                switch ($request->estado_solicitud) {
                    case '2': // Aprobada
                        $transaccion->estado = 'APROBADO';
                        break;
                    case '3': // Rechazada
                        $transaccion->estado = 'RECHAZADO';
                        break;
                    case '1': // Pendiente
                    case '4': // En Proceso
                        $transaccion->estado = 'PENDIENTE';
                        break;
                }

                $transaccion->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Solicitud actualizada correctamente'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la solicitud: ' . $e->getMessage()
            ], 500);
        }
    }
}
