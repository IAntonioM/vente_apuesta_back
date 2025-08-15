@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Usuarios</h1>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Usuario
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Búsqueda por nombre y correo -->
                <div class="row mb-3">
                    <div class="col-md-8">
                        <form method="GET" action="{{ route('usuarios.index') }}">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="nombre"
                                        placeholder="Buscar por nombre..." value="{{ request('nombre') }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="correo"
                                        placeholder="Buscar por correo..." value="{{ request('correo') }}">
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        @if (request('nombre') || request('correo'))
                                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-times"></i> Limpiar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (request('nombre') || request('correo'))
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end align-items-center">
                                <span class="badge bg-primary">
                                    Filtrado
                                    @if (request('nombre'))
                                        por nombre: "{{ request('nombre') }}"
                                    @endif
                                    @if (request('correo'))
                                        por correo: "{{ request('correo') }}"
                                    @endif
                                    <a href="{{ route('usuarios.index') }}" class="text-white ms-1" title="Limpiar filtro">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres y Apellidos</th>
                                        <th>Correo</th>
                                        <th>Nro. Cuenta</th>
                                        <th>Teléfono</th>
                                        <th>Banco</th>
                                        <th>Rol</th>
                                        <th>Creado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->nombres_apellidos }}</td>
                                            <td>{{ $usuario->correo }}</td>
                                            <td>{{ $usuario->nro_cuenta }}</td>
                                            <td>{{ $usuario->cel }}</td>
                                            <td>{{ $usuario->banco ? $usuario->banco->nombre : 'Sin banco' }}</td>
                                            <td>
                                                <span class="badge {{ $usuario->rol === 2 ? 'bg-danger' : 'bg-primary' }}">
                                                    {{ $usuario->rol === 2 ? 'Admin' : 'Usuario' }}
                                                </span>
                                            </td>
                                            <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('usuarios.show', $usuario) }}"
                                                        class="btn btn-info btn-sm text-white" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                                        class="btn btn-warning btn-sm text-dark" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                @if (request('nombre') || request('correo'))
                                                    No se encontraron usuarios con los criterios especificados
                                                    <br>
                                                    <a href="{{ route('usuarios.index') }}"
                                                        class="btn btn-sm btn-outline-primary mt-2">
                                                        Ver todos los usuarios
                                                    </a>
                                                @else
                                                    No hay usuarios registrados
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
