<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UserJuegoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
// /api/auth
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// /api/bancos
Route::prefix('bancos')->group(function () {
    Route::get('/', [BancoController::class, 'getBancosActivos']);
});
Route::get('/generate-storage-link', function () {

    // Definir las rutas correctas para tu estructura
    $publicPath = base_path('../public_html/storage');
    $storagePath = storage_path('app/public');

    // Verificar si ya existe
    if (File::exists($publicPath)) {
        return 'El enlace simbólico ya existe en: ' . url('/storage');
    }

    try {
        // Intentar crear el enlace simbólico manualmente
        if (!File::exists($storagePath)) {
            return 'Error: No existe la carpeta storage/app/public';
        }

        // Crear el enlace simbólico
        if (symlink($storagePath, $publicPath)) {
            return 'El enlace simbólico se creó correctamente. Accede en: ' . url('/storage');
        } else {
            return 'No se pudo crear el enlace simbólico. Problema de permisos.';
        }
    } catch (Exception $e) {
        // Si falla, intentar con artisan
        try {
            Artisan::call('storage:link');

            if (File::exists(public_path('storage'))) {
                return 'El enlace se creó con artisan pero en ubicación incorrecta. Muévelo manualmente.';
            }

            return 'Error con artisan: ' . $e->getMessage();
        } catch (Exception $e2) {
            return 'Error: ' . $e2->getMessage();
        }
    }
});

// Rutas protegidas con middleware auth:sanctum
Route::middleware(['auth:sanctum', 'juego.tiempoRonda'])->group(function () {

    // Compras
    //Route::post('/compras', [CompraController::class, 'crearCompra']);
    Route::get('/compras', [CompraController::class, 'misCompras']);

    // Juegos
    Route::get('/juegos', [JuegoController::class, 'listarJuegos']);
    Route::get('/juegos/{juegoId}/niveles', [JuegoController::class, 'listarNivelesPorJuego']);

    // Partidas
    Route::post('/partidas/jugar', [PartidaController::class, 'jugar']);
    Route::put('/partidas/{partidaId}/finalizar', [PartidaController::class, 'finalizar']);

    Route::get('/ventas', [VentaController::class, 'getVentas']);
    Route::get('/ventas/{id}', [VentaController::class, 'getVenta']);

    // WALLET (saldo y transacciones)
    Route::get('/wallet/saldo', [SaldoController::class, 'obtenerSaldo']);
    Route::get('/wallet/transacciones', [TransaccionController::class, 'misTransacciones']);
    //Route::post('/wallet/deposito', [TransaccionController::class, 'crearDeposito']);
    //Route::post('/wallet/retiro', [TransaccionController::class, 'crearRetiro']);

    // USER JUEGO
    Route::get('/user-juego/{juego_id}', [UserJuegoController::class, 'obtenerNivel']);
    //Route::post('/userJuego', [UserJuegoController::class, 'guardarNivel']);
    Route::get('/userJuego', [UserJuegoController::class, 'listarNivelesUsuario']);

    Route::get('/mis-solicitudes', [SolicitudController::class, 'listarPorUsuario']);


    Route::get('/tiempo-ronda', [UserJuegoController::class, 'obtenerTiempoRestante']);
});

// En routes/api.php
Route::middleware(['auth:sanctum', 'juego.tiempoRonda', 'menu.compra'])->group(function () {
    Route::post('/compras', [CompraController::class, 'crearCompra']);
});

// En routes/api.php
Route::middleware(['auth:sanctum', 'juego.tiempoRonda', 'menu.juego'])->group(function () {
    Route::post('/userJuego', [UserJuegoController::class, 'guardarNivel']);
});

// En routes/api.php
Route::middleware(['auth:sanctum', 'juego.tiempoRonda', 'menu.retiro'])->group(function () {
    // Route::post('/wallet/retiro', [TransaccionController::class, 'crearRetiro']);
    Route::post('/wallet/retiro', [TransaccionController::class, 'crearSolicitudRetiro']);
});

// En routes/api.php
Route::middleware(['auth:sanctum', 'juego.tiempoRonda', 'menu.deposito'])->group(function () {
    // Route::post('/wallet/deposito', [TransaccionController::class, 'crearDeposito']);
    Route::post('/wallet/deposito', [TransaccionController::class, 'crearSolicitudDeposito']);
});


Route::get('/imagenes/{filename}', function ($filename) {
    $path = public_path($filename); // <-- apunta a public/imagenes

    if (!file_exists($path)) {
        abort(404);
    }

    $mimeType = mime_content_type($path);
    return response()->file($path, [
        'Content-Type' => $mimeType
    ]);
});
