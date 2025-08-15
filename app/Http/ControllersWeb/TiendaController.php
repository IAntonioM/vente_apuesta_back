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

        $productos = $query->orderBy('created_at', 'desc')->get();

        return view('tienda.index', compact('productos'));
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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = '/images/' . $imageName;
        }

        Venta::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'img_url' => $imagePath
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $tienda->img_url;

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($tienda->img_url && file_exists(public_path($tienda->img_url))) {
                unlink(public_path($tienda->img_url));
            }

            $image = $request->file('imagen');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = '/images/' . $imageName;
        }

        $tienda->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'img_url' => $imagePath
        ]);

        return redirect()->route('tienda.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $tienda)
    {
        // Eliminar imagen si existe
        if ($tienda->img_url && file_exists(public_path($tienda->img_url))) {
            unlink(public_path($tienda->img_url));
        }

        $tienda->delete();

        return redirect()->route('tienda.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
