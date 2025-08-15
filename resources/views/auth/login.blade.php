@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="mb-4">Iniciar sesión</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="correo" class="form-control" id="correo" name="correo" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            {{-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div> --}}
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>
@endsection
