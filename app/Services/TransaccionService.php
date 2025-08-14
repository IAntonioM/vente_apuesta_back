<?php

namespace App\Services;

use App\Models\Transaccion;
use App\Models\SaldoUsuario;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaccionService
{
    public function crearTransaccion(array $data)
    {
        $userId      = $data['userId'];
        $tipo        = $data['tipo'];
        $monto       = $data['monto'];
        $metodoPago  = $data['metodo_pago'];
        $referencia  = $data['referencia'];
        $observacion = $data['observacion'];

        if (!in_array($tipo, ['DEPOSITO', 'RETIRO'])) {
            throw new Exception("Tipo de transacción no válido");
        }

        if ($monto <= 0) {
            throw new Exception("El monto debe ser mayor a cero");
        }

        DB::beginTransaction();

        try {
            $saldo = SaldoUsuario::firstOrCreate(
                ['userId' => $userId],
                ['saldo' => 0]
            );

            if ($tipo === 'RETIRO' && floatval($saldo->saldo) < $monto) {
                throw new Exception("Saldo insuficiente para el retiro");
            }

            if ($tipo === 'DEPOSITO') {
                $saldo->saldo += $monto;
            } else {
                $saldo->saldo -= $monto;
            }
            $saldo->save();

            $transaccion = Transaccion::create([
                'userId'      => $userId,
                'tipo'         => $tipo,
                'monto'        => $monto,
                'metodo_pago'  => $metodoPago,
                'referencia'   => $referencia,
                'observacion'  => $observacion,
                'estado'       => 'APROBADO'
            ]);

            DB::commit();
            return $transaccion;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getMisTransacciones(int $userId)
    {
        return Transaccion::where('userId', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getSaldoByUser(int $userId)
    {
        return SaldoUsuario::firstOrCreate(
            ['user_id' => $userId],
            ['saldo' => 0]
        );
    }
}
