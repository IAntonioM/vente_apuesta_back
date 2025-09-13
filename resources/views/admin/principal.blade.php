@extends('layouts.admin')

@section('title', 'Panel de Administración - Transacciones')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">Panel de Transacciones</h1>
                <p class="mb-0 text-muted">Gestiona retiros y depósitos de usuarios</p>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Depósitos
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    S/ {{ number_format($totalDepositos, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-up fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Retiros
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    S/ {{ number_format($totalRetiros, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-down fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Balance Total
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    S/ {{ number_format($totalDepositos - $totalRetiros, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-balance-scale fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Transacciones
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($totalTransacciones) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Filtros y búsqueda -->
<div class="card shadow mb-4" style="zoom: 90%;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filtros de Búsqueda</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('principal') }}">
            <!-- Primera fila: Búsqueda general -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search"
                        value="{{ request('search') }}"
                        placeholder="Buscar por usuario, referencia, método de pago...">
                </div>
            </div>

            <!-- Segunda fila: Filtros principales -->
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="tipo" class="form-label">Tipo de Transacción</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="TODOS" {{ request('tipo') == 'TODOS' ? 'selected' : '' }}>Todos</option>
                        <option value="DEPOSITO" {{ request('tipo') == 'DEPOSITO' ? 'selected' : '' }}>Depósitos</option>
                        <option value="RETIRO" {{ request('tipo') == 'RETIRO' ? 'selected' : '' }}>Retiros</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="TODOS" {{ request('estado') == 'TODOS' ? 'selected' : '' }}>Todos</option>
                        <option value="PENDIENTE" {{ request('estado') == 'PENDIENTE' ? 'selected' : '' }}>Pendiente</option>
                        <option value="APROBADO" {{ request('estado') == 'APROBADO' ? 'selected' : '' }}>Aprobado</option>
                        <option value="RECHAZADO" {{ request('estado') == 'RECHAZADO' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="fecha_desde" class="form-label">Fecha Desde</label>
                    <input type="date" class="form-control" id="fecha_desde" name="fecha_desde"
                        value="{{ request('fecha_desde') }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="fecha_hasta" class="form-label">Fecha Hasta</label>
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta"
                        value="{{ request('fecha_hasta') }}">
                </div>
            </div>

            <!-- Tercera fila: Opciones adicionales y botones -->
            <div class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <div class="form-check" style="padding-top: 8px;">
                        <input class="form-check-input" type="checkbox" value="1" id="flag_transaccion"
                            name="flag_transaccion" {{ request('flag_transaccion') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flag_transaccion">
                            <strong>Solo Transacciones Reales</strong>
                        </label>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <!-- Espacio vacío para equilibrar el diseño -->
                </div>

                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </div>

                <div class="col-md-2 mb-3">
                    <a href="{{ route('principal') }}" class="btn btn-outline-secondary btn-block">
                        <i class="fas fa-eraser"></i> Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

        <!-- Tabla de transacciones -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Lista de Transacciones
                    <span class="badge badge-secondary">{{ $transacciones->total() }} total</span>
                </h6>
            </div>
            <div class="card-body">
                @if ($transacciones->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Método</th>
                                    <th>Referencia</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transacciones as $transaccion)
                                    <tr>
                                        <td>{{ $transaccion->id }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $transaccion->usuario->nombres_apellidos }}</strong><br>
                                                <small class="text-muted">{{ $transaccion->usuario->correo }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($transaccion->tipo == 'DEPOSITO')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-arrow-up"></i> Depósito
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-arrow-down"></i> Retiro
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>S/ {{ number_format($transaccion->monto, 2) }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $transaccion->metodo_pago }}
                                            </span>

                                        </td>
                                        <td>{{ $transaccion->referencia ?: 'N/A' }}</td>
                                        <td>
                                            @switch($transaccion->estado)
                                                @case('PENDIENTE')
                                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                                @break

                                                @case('APROBADO')
                                                    <span class="badge bg-success">Aprobado</span>
                                                @break

                                                @case('RECHAZADO')
                                                    <span class="badge bg-danger">Rechazado</span>
                                                @break
                                            @endswitch

                                        </td>
                                        <td>
                                            <small>
                                                {{ $transaccion->created_at->format('d/m/Y') }}<br>
                                                {{ $transaccion->created_at->format('H:i:s') }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($transaccion->estado == 'PENDIENTE')
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        onclick="aprobarTransaccion({{ $transaccion->id }})"
                                                        title="Aprobar">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="rechazarTransaccion({{ $transaccion->id }})"
                                                        title="Rechazar">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center">
                        {{ $transacciones->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No se encontraron transacciones</h5>
                        <p class="text-muted">Intenta ajustar los filtros de búsqueda</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Formularios ocultos para acciones -->
    <form id="aprobar-form" action="" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    <form id="rechazar-form" action="" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

@endsection

@push('scripts')
    <script>
        function aprobarTransaccion(id) {
            if (confirm('¿Estás seguro de que deseas aprobar esta transacción?')) {
                const form = document.getElementById('aprobar-form');
                form.action = `/admin/transacciones/${id}/aprobar`;
                form.submit();
            }
        }

        function rechazarTransaccion(id) {
            if (confirm('¿Estás seguro de que deseas rechazar esta transacción?')) {
                const form = document.getElementById('rechazar-form');
                form.action = `/admin/transacciones/${id}/rechazar`;
                form.submit();
            }
        }

        // Auto-submit del formulario al cambiar los selects
        document.getElementById('tipo').addEventListener('change', function() {
            this.form.submit();
        });

        document.getElementById('estado').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
@endpush

@push('styles')
    <style>
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .badge {
            font-size: 0.875em;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush
