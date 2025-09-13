<?php

namespace App\Services;

use App\Models\Venta;
use Exception;

class VentaService
{
    public function crearVenta(array $data)
    {
        return Venta::create([
            'nombre'   => $data['nombre'],
            'precio'   => $data['precio'],
            'img_url'  => $data['img_url'] ?? null
        ]);
    }
public function getVentasByRonda($ronda)
{
    return Venta::where(function ($query) use ($ronda) {
        $query->where(function ($subQuery) use ($ronda) {
            // Ventas específicas de esta ronda (flag_mayor = 0 o null)
            $subQuery->where('n_ronda', $ronda)
                     ->where(function ($flagQuery) {
                         $flagQuery->where('flag_mayor', 0)
                                   ->orWhereNull('flag_mayor');
                     });
        })->orWhere(function ($subQuery) use ($ronda) {
            // Ventas que se muestran desde cierta ronda en adelante (flag_mayor = 1)
            $subQuery->where('flag_mayor', 1)
                     ->where('n_ronda', '<=', $ronda);
        });
    })
    ->orderBy('created_at', 'DESC')
    ->get();
}

    public function getAllVentas()
    {
        return Venta::orderBy('created_at', 'DESC')->get();
    }

    public function getVentaById(int $id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            throw new Exception('Venta no encontrada');
        }
        return $venta;
    }
}
