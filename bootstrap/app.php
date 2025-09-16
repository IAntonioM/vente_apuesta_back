<?php

use App\Http\Middleware\ValidarMenuCompra;
use App\Http\Middleware\ValidarMenuDeposito;
use App\Http\Middleware\ValidarMenuJuego;
use App\Http\Middleware\ValidarMenuRetiro;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         $middleware->alias([
            'menu.compra' => ValidarMenuCompra::class,
            'menu.juego' => ValidarMenuJuego::class,
            'menu.retiro' => ValidarMenuRetiro::class,
            'menu.deposito' => ValidarMenuDeposito::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
