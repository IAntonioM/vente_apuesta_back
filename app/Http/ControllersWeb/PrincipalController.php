<?php

namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Userss;

class PrincipalController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaccion::with(['usuario', 'usuario.banco']);

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

        // Estadísticas básicas (puedes aplicar los mismos filtros de fecha aquí si lo deseas)
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

    public function aprobar($id)
    {
        $transaccion = Transaccion::findOrFail($id);
        $transaccion->update(['estado' => 'APROBADO']);

        return back()->with('success', 'Transacción aprobada correctamente');
    }

    public function rechazar($id)
    {
        $transaccion = Transaccion::findOrFail($id);
        $transaccion->update(['estado' => 'RECHAZADO']);

        return back()->with('success', 'Transacción rechazada correctamente');
    }
}
