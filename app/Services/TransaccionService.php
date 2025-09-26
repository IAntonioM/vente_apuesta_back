<?php

namespace App\Services;

use App\Models\Transaccion;
use App\Models\SaldoUsuario;
use App\Models\Solicitud;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaccionService
{
    public function crearTransaccion(array $data)
    {
        $userId          = $data['userId'];
        $tipo            = $data['tipo'];
        $monto           = $data['monto'];
        $metodoPago      = $data['metodo_pago'];
        $referencia      = $data['referencia'];
        $observacion     = $data['observacion'];
        $flag_transaccion = $data['flag_transaccion'] ?? 0; // Valor por defecto 0
        $flag_crearSolicitud = $data['flag_crearSolicitud'] ?? 1; // ✅ default 1

        if (!in_array($tipo, ['DEPOSITO', 'RETIRO'])) {
            throw new Exception("Tipo de transacción no válido");
        }

        if ($monto < 0) {
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
                'userId'           => $userId,
                'tipo'             => $tipo,
                'monto'            => $monto,
                'metodo_pago'      => $metodoPago,
                'referencia'       => $referencia,
                'observacion'      => $observacion,
                'flag_transaccion' => $flag_transaccion,
                'estado'           => 'APROBADO'
            ]);

            // 📌 Si es RETIRO, también creamos la solicitud
            $solicitud = null; // inicializamos

            // 📌 Si es RETIRO, también creamos la solicitud
            if ($flag_crearSolicitud == 1) {
                if ($tipo === 'RETIRO') {
                    $dataSolicitud = [
                        'user_id'          => $userId,
                        'tipo_solicitud'   => 1, // 1 = RETIRO
                        'estado_solicitud' => 1, // 1 = PENDIENTE
                        'descripcion'      => "Solicitud de retiro por S/ {$monto}",
                        'motivo_rechazo'   => null,
                        'monto'            => $monto,
                    ];
                    $solicitud = Solicitud::create($dataSolicitud);
                }

                if ($tipo === 'DEPOSITO') {
                    $dataSolicitud = [
                        'user_id'          => $userId,
                        'tipo_solicitud'   => 2, // 2 = DEPOSITO
                        'estado_solicitud' => 2, // 2 = CONFIRMADO / EN PROCESO
                        'descripcion'      => "Solicitud de depósito por S/ {$monto}",
                        'motivo_rechazo'   => null,
                        'monto'            => $monto,
                    ];
                    $solicitud = Solicitud::create($dataSolicitud);
                }
            }
            if ($solicitud) {
                $transaccion->solicitudId = $solicitud->id;
                $transaccion->save();
            }
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
