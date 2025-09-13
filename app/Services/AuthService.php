<?php

namespace App\Services;

use App\Models\Userss;
use App\Models\Banco;
use App\Models\Transaccion;
use App\Models\SaldoUsuario;
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

        // Validar banco activo
        $banco = Banco::where('id', $data['bancoId'])
            ->where('estado', true)
            ->first();

        if (!$banco) {
            throw new Exception("El banco no existe o está inactivo");
        }

        // Crear usuario
        $user = Userss::create([
            'nombres_apellidos'  => $data['nombres_apellidos'],
            'correo'             => $data['correo'],
            'nro_cuenta'         => $data['nro_cuenta'],
            'bancoId'            => $data['bancoId'],
            'cel'                => $data['cel'],
            'password'           => Hash::make($data['password']),
            'flag_ronda_1'       => 1, // valor por defecto
            'flag_puede_retirar' => 0  // valor por defecto
        ]);


        // Crear saldo inicial si no existe
        $saldo = SaldoUsuario::firstOrCreate(
            ['userId' => $user->id],
            ['saldo' => 0]
        );

        // Bono de registro
        $saldo->saldo += 30;
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
