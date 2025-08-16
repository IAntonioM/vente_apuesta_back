<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UserJuegoController;
use App\Http\Controllers\VentaController;
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

// Rutas protegidas con middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Compras
    Route::post('/compras', [CompraController::class, 'crearCompra']);
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
    Route::post('/wallet/deposito', [TransaccionController::class, 'crearDeposito']);
    Route::post('/wallet/retiro', [TransaccionController::class, 'crearRetiro']);

    // USER JUEGO
    Route::get('/user-juego/{juego_id}', [UserJuegoController::class, 'obtenerNivel']);
    Route::post('/userJuego', [UserJuegoController::class, 'guardarNivel']);
    Route::get('/userJuego', [UserJuegoController::class, 'listarNivelesUsuario']);
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
