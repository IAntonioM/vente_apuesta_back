<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\UserJuego;
use App\Services\TransaccionService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaccionController extends Controller
{
    protected $transaccionService;

    public function __construct(TransaccionService $transaccionService)
    {
        $this->transaccionService = $transaccionService;
    }

    // DEPÓSITO
    public function crearDeposito(Request $request)
    {
        try {
            $user = $request->user();

            $montoDeposito = $request->input('monto');

            // ✅ Validar que el monto a depositar sea mayor o igual al último retiro
            if ($montoDeposito < $user->ultimo_retiro) {
                return response()->json([
                    'success' => false,
                    'message' => "El monto a depositar debe ser mayor o igual a tu último retiro ({$user->ultimo_retiro}).",
                    'ultimo_retiro' => $user->ultimo_retiro,
                    'monto_ingresado' => $montoDeposito
                ], 422); // 422 = Unprocessable Entity
            }

            $data = [
                'userId'          => $user->id,
                'tipo'            => 'DEPOSITO',
                'monto'           => $montoDeposito,
                'metodo_pago'     => $request->input('metodo_pago'),
                'referencia'      => $request->input('referencia'),
                'observacion'     => $request->input('observacion'),
                'flag_transaccion' => 1,
            ];

            // Crear transacción
            $transaccion = $this->transaccionService->crearTransaccion($data);

            // ✅ Resetear monto y actualizar menú
            $user->update([
                'ultimo_retiro' => 0, // 👈 monto reseteado
                'menu_actual'   => 1, // 👈 compra
            ]);

            return response()->json([
                'message'     => 'Depósito exitoso',
                'transaccion' => $transaccion,
                'user'        => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al registrar depósito'], 400);
        }
    }

    // RETIRO
    public function crearRetiro(Request $request)
    {
        try {
            $user = $request->user();

            $data = [
                'userId'          => $user->id,
                'tipo'            => 'RETIRO',
                'monto'           => $request->input('monto'),
                'metodo_pago'     => $request->input('metodo_pago'),
                'observacion'     => $request->input('observacion'),
                'flag_transaccion' => 1,
                'referencia'      => $request->input('referencia'),
            ];

            // Crear la transacción
            $transaccion = $this->transaccionService->crearTransaccion($data);

            // ✅ Si todo fue bien, actualizar flag_puede_retirar en 0
            $user->update([
                'flag_puede_retirar' => 0,
                'menu_actual'        => 4, // 👈 retiro completado
                'ultimo_retiro'      => $request->input('monto'), // 👈 guardamos monto
            ]);

            // ✅ Traer UserJuego con juego_id = 1
            $userJuego = UserJuego::firstOrCreate(
                ['user_id' => $user->id, 'juego_id' => 1],
                ['nivel_actual' => 1, 'ronda_actual' => 1] // valores iniciales si no existe
            );

            return response()->json([
                'message' => 'Retiro exitoso',
                'transaccion' => $transaccion,
                'user' => $user,
                'userJuego' => $userJuego
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ?? 'Error al registrar retiro'], 400);
        }
    }

    // CREAR SOLICITUD DE RETIRO
    public function crearSolicitudRetiro(Request $request)
    {
        try {
            $user = $request->user();

            // Validar campos requeridos
            $request->validate([
                'monto' => 'required|numeric|min:0.01',
                'banco' => 'required|int',
                'nmr_cuenta' => 'required|string|max:50',
            ]);

            $montoRetiro = $request->input('monto');
            $banco = $request->input('banco');
            $nmrCuenta = $request->input('nmr_cuenta');

            DB::beginTransaction();

            try {
                // ✅ Obtener el último sub_id y generar el nuevo
                $ultimaSolicitud = Solicitud::orderBy('sub_id', 'desc')->first();
                $nuevoSubId = $ultimaSolicitud && $ultimaSolicitud->sub_id ? $ultimaSolicitud->sub_id + 1 : 1;

                // Crear solicitud de retiro
                $solicitud = Solicitud::create([
                    'user_id' => $user->id,
                    'tipo_solicitud' => 1, // 1 = RETIRO
                    'estado_solicitud' => 1, // 1 = PENDIENTE
                    'descripcion' => "Solicitud de retiro por S/ {$montoRetiro}",
                    'motivo_rechazo' => null,
                    'monto' => $montoRetiro,
                    'banco_id' => $banco,
                    'numero_cuenta' => $nmrCuenta,
                    'evidencia_file' => null, // No hay evidencia en retiro
                    'sub_id' => $nuevoSubId,
                ]);

                // ✅ Crear la transacción
                $data = [
                    'userId' => $user->id,
                    'tipo' => 'RETIRO',
                    'monto' => $montoRetiro,
                    'metodo_pago' => 'TRANSFERENCIA', // o el que corresponda
                    'observacion' => "Retiro a cuenta {$nmrCuenta}",
                    'flag_transaccion' => 1,
                    'referencia' => "SOL-" . str_pad($nuevoSubId, 6, '0', STR_PAD_LEFT),
                ];

                $transaccion = $this->transaccionService->crearTransaccion($data);

                // ✅ Actualizar usuario
                $user->update([
                    'flag_puede_retirar' => 0,
                    'menu_actual' => 4, // retiro completado
                    'ultimo_retiro' => $montoRetiro,
                ]);

                // ✅ Traer UserJuego con juego_id = 1
                $userJuego = UserJuego::firstOrCreate(
                    ['user_id' => $user->id, 'juego_id' => 1],
                    ['nivel_actual' => 1, 'ronda_actual' => 1]
                );

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Solicitud de retiro creada exitosamente. Está pendiente de aprobación.',
                    'solicitud' => [
                        'id' => $solicitud->id,
                        'sub_id' => str_pad($nuevoSubId, 6, '0', STR_PAD_LEFT),
                        'monto' => $solicitud->monto,
                        'estado' => $solicitud->estado_solicitud,
                        'created_at' => $solicitud->created_at,
                    ],
                    'transaccion' => $transaccion,
                    'user' => $user->fresh(),
                    'userJuego' => $userJuego
                ], 201);
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?? 'Error al crear solicitud de retiro'
            ], 400);
        }
    }


    // LISTADO
    public function misTransacciones(Request $request)
    {
        try {
            $lista = $this->transaccionService->getMisTransacciones($request->user()->id);
            return response()->json($lista);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener transacciones'], 500);
        }
    }



    // CREAR SOLICITUD DE DEPÓSITO (reemplaza a crearDeposito)
    public function crearSolicitudDeposito(Request $request)
    {
        try {
            $user = $request->user();

            // Validar campos requeridos
            $request->validate([
                'monto' => 'required|numeric|min:0.01',
                'banco' => 'required|int',
                'nmr_cuenta' => 'required|string|max:50',
                'evidencia_file' => 'required|string', // Base64
            ]);

            $montoDeposito = $request->input('monto');

            // ✅ Validar que el monto a depositar sea mayor o igual al último retiro
            if ($montoDeposito < $user->ultimo_retiro) {
                return response()->json([
                    'success' => false,
                    'message' => "El monto a depositar debe ser mayor o igual a tu último retiro ({$user->ultimo_retiro}).",
                    'ultimo_retiro' => $user->ultimo_retiro,
                    'monto_ingresado' => $montoDeposito
                ], 422);
            }

            // Obtener datos del request
            $banco = $request->input('banco');
            $nmrCuenta = $request->input('nmr_cuenta');
            $evidenciaFile = $request->input('evidencia_file'); // Base64

            // Procesar archivo de evidencia (guardar en app/private/evidencias)
            $nombreArchivo = null;
            if ($evidenciaFile) {
                try {
                    // Detectar extensión del base64
                    $extension = $this->getExtensionFromBase64($evidenciaFile);

                    // Remover el header del base64 si lo tiene (data:image/jpeg;base64,)
                    if (strpos($evidenciaFile, ',') !== false) {
                        $evidenciaFile = explode(',', $evidenciaFile)[1];
                    }

                    // Decodificar base64
                    $fileData = base64_decode($evidenciaFile);

                    // Generar nombre único para el archivo
                    $nombreArchivo = 'evidencias/deposito_' . time() . '.' . $extension;

                    // Guardar archivo en storage/app/private/evidencias
                    Storage::disk('local')->put($nombreArchivo, $fileData);
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al procesar el archivo de evidencia: ' . $e->getMessage()
                    ], 400);
                }
            }

            // Crear solicitud de depósito
            DB::beginTransaction();

            try {
                // ✅ Obtener el último sub_id y generar el nuevo
                $ultimaSolicitud = Solicitud::orderBy('sub_id', 'desc')->first();
                $nuevoSubId = $ultimaSolicitud && $ultimaSolicitud->sub_id ? $ultimaSolicitud->sub_id + 1 : 1;

                $solicitud = Solicitud::create([
                    'user_id' => $user->id,
                    'tipo_solicitud' => 2, // 2 = DEPÓSITO
                    'estado_solicitud' => 1, // 1 = PENDIENTE
                    'descripcion' => "Solicitud de depósito por S/ {$montoDeposito}",
                    'motivo_rechazo' => null,
                    'monto' => $montoDeposito,
                    'banco_id' => $banco,
                    'numero_cuenta' => $nmrCuenta,
                    'evidencia_file' => $nombreArchivo,
                    'sub_id' => $nuevoSubId, // 👈 Sub ID incremental
                ]);

                // ✅ Resetear ultimo_retiro y actualizar menú solo después de crear la solicitud exitosamente
                $user->update([
                    'ultimo_retiro' => 0,
                    'menu_actual' => 1,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Solicitud de depósito creada exitosamente. Está pendiente de aprobación.',
                    'solicitud' => [
                        'id' => $solicitud->id,
                        'sub_id' => str_pad($nuevoSubId, 6, '0', STR_PAD_LEFT), // 👈 Formato 000001
                        'monto' => $solicitud->monto,
                        'estado' => $solicitud->estado_solicitud,
                        'created_at' => $solicitud->created_at,
                    ],
                    'user' => $user->fresh(),
                ], 201);
            } catch (Exception $e) {
                DB::rollBack();

                // Eliminar archivo si se creó pero falló la solicitud
                if ($nombreArchivo && Storage::disk('local')->exists($nombreArchivo)) {
                    Storage::disk('local')->delete($nombreArchivo);
                }

                throw $e;
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?? 'Error al crear solicitud de depósito'
            ], 400);
        }
    }

    // OPCIONAL: Función para detectar extensión de archivo base64
    private function getExtensionFromBase64($base64String)
    {
        $data = explode(',', $base64String);

        if (count($data) < 2) {
            return 'jpg'; // Default
        }

        $header = $data[0];

        if (strpos($header, 'image/jpeg') !== false) {
            return 'jpg';
        } elseif (strpos($header, 'image/png') !== false) {
            return 'png';
        } elseif (strpos($header, 'image/gif') !== false) {
            return 'gif';
        } elseif (strpos($header, 'application/pdf') !== false) {
            return 'pdf';
        }

        return 'jpg'; // Default
    }
}
