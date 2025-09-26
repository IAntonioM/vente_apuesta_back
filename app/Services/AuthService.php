<?php

namespace App\Services;

use App\Models\Userss;
use App\Models\Banco;
use App\Models\Transaccion;
use App\Models\SaldoUsuario;
use App\Models\UserJuego;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService
{
    public function register(array $data)
    {
        // Verificar si ya existe el correo
        if (Userss::where('correo', $data['correo'])->exists()) {
            throw new Exception("El correo ya está registrado");
        }

        if (Userss::where('cel', $data['cel'])->exists()) {
            throw new Exception("El celular ya está registrado");
        }

        // Crear usuario
        $user = Userss::create([
            'nombres_apellidos'  => $data['nombres_apellidos'],
            'correo'             => $data['correo'],
            'cel'                => $data['cel'],
            'password'           => Hash::make($data['password']),
            'flag_ronda_1'       => 1, // valor por defecto
            'flag_puede_retirar' => 0  // valor por defecto
        ]);

        // 🔹 Crear UserJuego por defecto al registrarse
        UserJuego::create([
            'user_id'        => $user->id,          // ID del usuario recién creado
            'juego_id'       => 1,                  // Siempre juego ID 1
            'nivel_actual'   => 1,                  // Siempre nivel 1
            'ronda_actual'   => 1,                  // Siempre ronda 1
            'f_ronda_update' => now(),              // Fecha actual
            // created_at y updated_at son automáticos
        ]);

        // Crear saldo inicial si no existe
        $saldo = SaldoUsuario::firstOrCreate(
            ['userId' => $user->id],
            ['saldo' => 0]
        );

        // Bono de registro
        $saldo->saldo += 10;
        $saldo->save();

        // Registrar transacción de bono
        Transaccion::create([
            'userId'       => $user->id,
            'tipo'         => 'DEPOSITO',
            'monto'        => 30,
            'metodo_pago'  => 'BONO_REGISTRO',
            'referencia'   => 'Registro inicial',
            'observacion'  => 'Bono de bienvenida por registro',
            'estado'       => 'APROBADO',
        ]);

        // Generar token
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $data)
    {
        $credentials = [
            'correo' => $data['correo'],
            'password' => $data['password']
        ];

        if (!Auth::attempt($credentials)) {
            throw new Exception("Credenciales incorrectas");
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
