@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Editar Usuario</h1>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombres_apellidos" class="form-label">Nombres y Apellidos *</label>
                                        <input type="text"
                                            class="form-control @error('nombres_apellidos') is-invalid @enderror"
                                            id="nombres_apellidos" name="nombres_apellidos"
                                            value="{{ old('nombres_apellidos', $usuario->nombres_apellidos) }}" required>
                                        @error('nombres_apellidos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico *</label>
                                        <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                            id="correo" name="correo" value="{{ old('correo', $usuario->correo) }}"
                                            required>
                                        @error('correo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nro_cuenta" class="form-label">Número de Cuenta *</label>
                                        <input type="text" class="form-control @error('nro_cuenta') is-invalid @enderror"
                                            id="nro_cuenta" name="nro_cuenta"
                                            value="{{ old('nro_cuenta', $usuario->nro_cuenta) }}" required>
                                        @error('nro_cuenta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cel" class="form-label">Teléfono *</label>
                                        <input type="text" class="form-control @error('cel') is-invalid @enderror"
                                            id="cel" name="cel" value="{{ old('cel', $usuario->cel) }}" required>
                                        @error('cel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        <div class="form-text">Dejar en blanco para mantener la contraseña actual</div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rol" class="form-label">Rol *</label>
                                        <select class="form-select @error('rol') is-invalid @enderror" id="rol"
                                            name="rol" required>
                                            <option value="">Seleccionar rol</option>
                                            <option value="1" {{ old('rol', $usuario->rol) == 1 ? 'selected' : '' }}>
                                                Usuario</option>
                                            <option value="2" {{ old('rol', $usuario->rol) == 2 ? 'selected' : '' }}>
                                                Administrador</option>
                                        </select>
                                        @error('rol')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bancoId" class="form-label">Banco *</label>
                                        <select class="form-select @error('bancoId') is-invalid @enderror" id="bancoId"
                                            name="bancoId" required>
                                            <option value="">Seleccionar banco</option>
                                            @foreach ($bancos as $banco)
                                                <option value="{{ $banco->id }}"
                                                    {{ old('bancoId', $usuario->bancoId) == $banco->id ? 'selected' : '' }}>
                                                    {{ $banco->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bancoId')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Actualizar Usuario
                                    </button>
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary ms-2">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
