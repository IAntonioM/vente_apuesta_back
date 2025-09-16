<?php

namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Venta::query();

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por n_ronda
        if ($request->filled('n_ronda')) {
            $query->where('n_ronda', $request->n_ronda);
        }

        // Filtro por nivel
        if ($request->filled('nivel')) {
            $query->where('nivel', $request->nivel);
        }

        // Filtro por flag_mayor
        if ($request->filled('flag_mayor')) {
            $query->where('flag_mayor', $request->flag_mayor === '1');
        }

        // Ordenar por n_ronda ASC, nivel ASC como en tu consulta SQL
        $productos = $query->orderBy('n_ronda', 'asc')
                          ->orderBy('nivel', 'asc')
                          ->get();

        // Obtener todas las rondas y niveles disponibles para los filtros
        $rondas = Venta::distinct()->orderBy('n_ronda')->pluck('n_ronda');
        $niveles = Venta::distinct()->orderBy('nivel')->pluck('nivel');

        return view('tienda.index', compact('productos', 'rondas', 'niveles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tienda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'n_ronda' => 'required|integer|min:1',
            'nivel' => 'required|integer|min:1',
            'flag_mayor' => 'required|boolean',
            'ganancia' => 'nullable|numeric|min:0',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('imagen')) {
            // Guarda en storage/app/public/images
            $imagePath = $request->file('imagen')->store('images', 'public');
        }

        Venta::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'n_ronda' => $request->n_ronda,
            'nivel' => $request->nivel,
            'flag_mayor' => $request->flag_mayor,
            'ganancia' => $request->ganancia,
            'img_url' => $imagePath // Guarda "images/xxx.png"
        ]);

        return redirect()->route('tienda.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $tienda)
    {
        return view('tienda.show', compact('tienda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $tienda)
    {
        return view('tienda.edit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $tienda)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'n_ronda' => 'required|integer|min:1',
            'nivel' => 'required|integer|min:1',
            'flag_mayor' => 'required|boolean',
            'ganancia' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $tienda->img_url;

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe en storage
            if ($tienda->img_url && Storage::disk('public')->exists($tienda->img_url)) {
                Storage::disk('public')->delete($tienda->img_url);
            }

            // Guardar nueva imagen en storage/app/public/images
            $imagePath = $request->file('imagen')->store('images', 'public');
        }

        $tienda->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'n_ronda' => $request->n_ronda,
            'nivel' => $request->nivel,
            'flag_mayor' => $request->flag_mayor,
            'ganancia' => $request->ganancia,
            'img_url' => $imagePath // Solo guarda "images/nombre.png"
        ]);

        return redirect()->route('tienda.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $tienda)
    {
        // Eliminar imagen si existe - Corregido para usar Storage consistentemente
        if ($tienda->img_url && Storage::disk('public')->exists($tienda->img_url)) {
            Storage::disk('public')->delete($tienda->img_url);
        }

        $tienda->delete();

        return redirect()->route('tienda.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
