<?php

use App\Http\ControllersWeb\LoginController;
use App\Http\ControllersWeb\PrincipalController;
use App\Http\ControllersWeb\RegisterController;
use App\Http\ControllersWeb\TerminosController;
use App\Http\ControllersWeb\TiendaController;
use App\Http\ControllersWeb\UsuarioController;
use Illuminate\Support\Facades\Route;

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/terminos-condiciones', [TerminosController::class, 'showTerminosView'])->name('terminos');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/principal', [PrincipalController::class, 'index'])->name('principal');
    Route::patch('/principal/transacciones/{id}/aprobar', [PrincipalController::class, 'aprobar'])->name('transacciones.aprobar');
    Route::patch('/principal/transacciones/{id}/rechazar', [PrincipalController::class, 'rechazar'])->name('transacciones.rechazar');
    Route::resource('tienda', TiendaController::class);
    Route::resource('usuarios', UsuarioController::class);
});
