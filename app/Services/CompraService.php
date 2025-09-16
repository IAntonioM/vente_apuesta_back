<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\Venta;
use App\Models\Transaccion;
use App\Models\SaldoUsuario;
use Illuminate\Support\Facades\DB;
use Exception;

class CompraService
{
    public function crearCompra(array $data)
    {
        $userId   = $data['userId'] ?? null;
        $ventaId  = $data['ventaId'] ?? null;
        $cantidad = $data['cantidad'] ?? null;

        if (!$ventaId || !$cantidad || $cantidad <= 0) {
            throw new Exception('Datos de compra inválidos');
        }

        return DB::transaction(function () use ($userId, $ventaId, $cantidad) {
            // 1. Validar venta
            $venta = Venta::find($ventaId);
            if (!$venta) {
                throw new Exception('Producto no encontrado');
            }

            // 2. Stock suficiente
            if ($cantidad > $venta->cantidad) {
                throw new Exception("Stock insuficiente. Solo hay {$venta->cantidad} unidades disponibles");
            }

            // 3. Precio válido
            if ($venta->precio <= 0) {
                throw new Exception('El producto tiene un precio inválido');
            }

            // 4. Calcular total
            $total = $venta->precio * $cantidad;
            if ($total <= 0) {
                throw new Exception('El total de la compra debe ser mayor a 0');
            }

            // 5. Verificar saldo
            $saldo = SaldoUsuario::firstOrCreate(
                ['userId' => $userId],
                ['saldo' => 0]
            );

            if ($saldo->saldo < $total) {
                throw new Exception('Saldo insuficiente para completar la compra');
            }
            $monto_compra   = $venta->precio * $cantidad;
            $monto_ganancia = $venta->ganancia * $cantidad;
            $monto_venta    = $monto_compra + $monto_ganancia;
            // 6. Restar saldo
            //  $saldo->saldo -= $total;
            //  $saldo->save();

            // 7. Reducir stock
            $venta->cantidad -= $cantidad;
            $venta->save();

            // 8. Crear transacción
            $transaccion = Transaccion::create([
                'userId'     => $userId,
                'tipo'        => 'RETIRO',
                'monto'       => $total,
                'metodo_pago' => 'COMPRA',
                'referencia'  => "Compra de {$venta->nombre}",
                'observacion' => "Compra de {$cantidad} unidad(es) de {$venta->nombre} - Total: \${$total}",
                'estado'      => 'APROBADO'
            ]);

            // 9. Crear compra
            $compra = Compra::create([
                'userId'       => $userId,
                'ventaId'      => $ventaId,
                'transaccionId' => $transaccion->id,
                'cantidad'      => $cantidad,
                'precio_unitario' => $venta->precio,
                'total'         => $total,
                'fecha' => now(),
                'monto_compra'   => $monto_compra,
                'monto_ganancia' => $monto_ganancia,
                'monto_venta'    => $monto_venta,
            ]);

            // 10. Retornar con datos extra
            return [
                'compra' => $compra,
                'venta' => [
                    'nombre' => $venta->nombre,
                    'precio' => $venta->precio
                ],
                'transaccion' => [
                    'id'    => $transaccion->id,
                    'monto' => $transaccion->monto
                ]
            ];
        });
    }

    public function getComprasPorUsuario(int $userId)
    {
        return Compra::where('userId', $userId)
            ->orderBy('fecha', 'DESC')
            ->get();
    }
}
