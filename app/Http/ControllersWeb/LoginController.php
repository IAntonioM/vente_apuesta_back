<?php

namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Solo usuarios con rol = 2 pueden loguear
        $credentials['rol'] = 2;

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('principal');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden o no tienes permisos.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
