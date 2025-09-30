<?php

namespace App\Http\ControllersWeb;


use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\Banco;
use App\Models\Userss;
use App\Models\TipoSolicitud;
use App\Models\EstadoSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Solicitud::with(['banco', 'user', 'tipoSolicitud', 'estadoSolicitud']);

        // Filtro por número de cuenta
        if ($request->filled('numero_cuenta')) {
            $query->where('numero_cuenta', 'like', '%' . $request->numero_cuenta . '%');
        }

        // Filtro por usuario
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filtro por tipo de solicitud
        if ($request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $request->tipo_solicitud);
        }

        // Filtro por estado de solicitud
        if ($request->filled('estado_solicitud')) {
            $query->where('estado_solicitud', $request->estado_solicitud);
        }

        // Filtro por banco
        if ($request->filled('banco_id')) {
            $query->where('banco_id', $request->banco_id);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')->get();

        // Para los filtros en la vista
        $usuarios = Userss::all();
        $bancos = Banco::where('estado', 1)->get();
        $tiposSolicitud = TipoSolicitud::all();
        $estadosSolicitud = EstadoSolicitud::all();

        return view('solicitud.index', compact('solicitudes', 'usuarios', 'bancos', 'tiposSolicitud', 'estadosSolicitud'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bancos = Banco::where('estado', 1)->get();
        $usuarios = Userss::all();
        $tiposSolicitud = TipoSolicitud::all();
        $estadosSolicitud = EstadoSolicitud::all();

        return view('solicitud.create', compact('bancos', 'usuarios', 'tiposSolicitud', 'estadosSolicitud'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_cuenta' => 'nullable|string|max:50',
            'banco_id' => 'nullable|exists:bancos,id',
            'user_id' => 'nullable|exists:userss,id',
            'tipo_solicitud' => 'required|exists:tipos_solicitud,id',
            'estado_solicitud' => 'required|exists:estados_solicitud,id',
            'descripcion' => 'nullable|string|max:500',
            'motivo_rechazo' => 'nullable|string|max:500',
            'monto' => 'nullable|numeric|min:0|max:99999999.99',
            'evidencia_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240' // 10MB max
        ]);

        $data = [
            'numero_cuenta' => $request->numero_cuenta,
            'banco_id' => $request->banco_id,
            'user_id' => $request->user_id,
            'tipo_solicitud' => $request->tipo_solicitud,
            'estado_solicitud' => $request->estado_solicitud,
            'descripcion' => $request->descripcion,
            'motivo_rechazo' => $request->motivo_rechazo,
            'monto' => $request->monto
        ];

        // Manejar archivo de evidencia
        if ($request->hasFile('evidencia_file')) {
            $file = $request->file('evidencia_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('evidencias', $fileName, 'private');
            $data['evidencia_file'] = $filePath;
        }

        Solicitud::create($data);

        return redirect()->route('solicitud.index')->with('success', 'Solicitud creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        $solicitud->load(['banco', 'user', 'tipoSolicitud', 'estadoSolicitud']);
        return view('solicitud.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        $solicitud = Solicitud::findOrFail($solicitud->id);

        $bancos = Banco::where('estado', 1)->get();
        $usuarios = Userss::all();
        $tiposSolicitud = TipoSolicitud::all();
        $estadosSolicitud = EstadoSolicitud::all();

        return view('solicitud.edit', compact('solicitud', 'bancos', 'usuarios', 'tiposSolicitud', 'estadosSolicitud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'numero_cuenta' => 'nullable|string|max:50',
            'banco_id' => 'nullable|exists:bancos,id',
            'user_id' => 'nullable|exists:userss,id',
            'tipo_solicitud' => 'required|exists:tipos_solicitud,id',
            'estado_solicitud' => 'required|exists:estados_solicitud,id',
            'descripcion' => 'nullable|string|max:500',
            'motivo_rechazo' => 'nullable|string|max:500',
            'monto' => 'nullable|numeric|min:0|max:99999999.99',
            'evidencia_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
        ]);

        // Si el estado cambia a "Rechazada" (ID 3), requerir motivo de rechazo
        if ($request->estado_solicitud == 3 && empty($request->motivo_rechazo)) {
            return back()->withErrors(['motivo_rechazo' => 'El motivo de rechazo es obligatorio cuando se rechaza una solicitud.']);
        }

        $data = [
            'numero_cuenta' => $request->numero_cuenta,
            'banco_id' => $request->banco_id,
            'user_id' => $request->user_id,
            'tipo_solicitud' => $request->tipo_solicitud,
            'estado_solicitud' => $request->estado_solicitud,
            'descripcion' => $request->descripcion,
            'motivo_rechazo' => $request->motivo_rechazo,
            'monto' => $request->monto
        ];

        // Manejar archivo de evidencia
        if ($request->hasFile('evidencia_file')) {
            // Eliminar archivo anterior si existe
            if ($solicitud->evidencia_file && Storage::disk('private')->exists($solicitud->evidencia_file)) {
                Storage::disk('private')->delete($solicitud->evidencia_file);
            }

            $file = $request->file('evidencia_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('evidencias', $fileName, 'private');
            $data['evidencia_file'] = $filePath;
        }

        $solicitud->update($data);

        return redirect()->route('solicitud.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        // Eliminar archivo de evidencia si existe
        if ($solicitud->evidencia_file && Storage::disk('private')->exists($solicitud->evidencia_file)) {
            Storage::disk('private')->delete($solicitud->evidencia_file);
        }

        $solicitud->delete();
        return redirect()->route('solicitud.index')->with('success', 'Solicitud eliminada exitosamente.');
    }

    /**
     * Descargar archivo de evidencia
     */
    public function descargarEvidencia(Solicitud $solicitud)
    {
        if (!$solicitud->evidencia_file || !Storage::disk('private')->exists($solicitud->evidencia_file)) {
            abort(404, 'Archivo no encontrado');
        }

        return Storage::disk('private')->download($solicitud->evidencia_file);
    }
}
