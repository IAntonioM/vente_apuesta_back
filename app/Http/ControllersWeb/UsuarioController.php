<?php

namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;
use App\Models\Userss;
use App\Models\Banco;
use App\Models\SaldoUsuario;
use App\Models\Solicitud;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Userss::with('banco');

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombres_apellidos', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por correo
        if ($request->filled('correo')) {
            $query->where('correo', 'like', '%' . $request->correo . '%');
        }

        $usuarios = $query->orderBy('created_at', 'desc')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bancos = Banco::all();
        return view('usuarios.create', compact('bancos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres_apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:userss,correo|max:255',
            'nro_cuenta' => 'required|string|max:255',
            'cel' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:1,2', // <-- Cambiado a 1 = Usuario, 2 = Admin
            'bancoId' => 'required|exists:bancos,id'
        ]);

        Userss::create([
            'nombres_apellidos' => $request->nombres_apellidos,
            'correo' => $request->correo,
            'nro_cuenta' => $request->nro_cuenta,
            'cel' => $request->cel,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'bancoId' => $request->bancoId
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Userss $usuario)
    {
        $usuario->load('banco', 'saldoUsuario');
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Userss $usuario)
    {
        $bancos = Banco::all();
        return view('usuarios.edit', compact('usuario', 'bancos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Userss $usuario)
    {
        $request->validate([
            'nombres_apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:userss,correo,' . $usuario->id,
            'nro_cuenta' => 'required|string|max:255',
            'cel' => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
            'rol' => 'required|in:1,2', // <-- Cambiado a 1 = Usuario, 2 = Admin
            'bancoId' => 'required|exists:bancos,id'
        ]);

        $updateData = [
            'nombres_apellidos' => $request->nombres_apellidos,
            'correo' => $request->correo,
            'nro_cuenta' => $request->nro_cuenta,
            'cel' => $request->cel,
            'rol' => $request->rol,
            'bancoId' => $request->bancoId
        ];

        // Solo actualizar contraseña si se proporciona
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $usuario->update($updateData);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function editSaldoUser(Userss $usuario, $solicitud = null)
    {
        $usuario->load('banco', 'saldoUsuario');

        $solicitudData = null;
        if ($solicitud) {
            $solicitudData = Solicitud::with('banco')->find($solicitud);
        }

        return view('usuarios.editSaldo', compact('usuario', 'solicitudData'));
    }

    /**
     * Update user balance by creating a transaction.
     */
    public function updateSaldoUser(Request $request, Userss $usuario)
    {
        $request->validate([
            'tipo' => 'required|in:DEPOSITO,RETIRO',
            'monto' => 'required|numeric|min:0.01',
            'referencia' => 'nullable|string|max:255',
            'observacion' => 'nullable|string|max:500',
            'metodo_pago' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            // Crear la transacción
            Transaccion::create([
                'solicitudId' => null,
                'tipo' => $request->tipo,
                'monto' => $request->monto,
                'estado' => 'APROBADO',
                'flag_transaccion' => 1,
                'referencia' => $request->referencia,
                'observacion' => $request->observacion,
                'metodo_pago' => $request->metodo_pago,
                'userId' => $usuario->id
            ]);

            // Obtener o crear el saldo del usuario
            $saldoUsuario = SaldoUsuario::firstOrCreate(
                ['userId' => $usuario->id],
                ['saldo' => 0]
            );

            // Actualizar el saldo según el tipo de transacción
            if ($request->tipo === 'DEPOSITO') {
                $saldoUsuario->saldo += $request->monto;
            } else { // RETIRO
                $saldoUsuario->saldo -= $request->monto;
            }

            $saldoUsuario->save();

            DB::commit();

            return redirect()->route('usuarios.index')->with('success', 'Saldo actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al actualizar el saldo: ' . $e->getMessage());
        }
    }
}
