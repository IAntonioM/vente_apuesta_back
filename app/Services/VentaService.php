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
