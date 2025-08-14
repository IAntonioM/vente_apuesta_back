<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        try {
            $result = $this->authService->register($request->all());
            return response()->json([
                'message' => 'Usuario creado correctamente',
                'user'    => $result['user'],
                'token'   => $result['token']
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request->all());
            return response()->json([
                'message' => 'Login exitoso',
                'user'    => $result['user'],
                'token'   => $result['token']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout();
            return response()->json([
                'message' => 'Logout exitoso'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
