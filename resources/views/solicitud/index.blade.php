@extends('layouts.admin')

@section('title', 'Gestión de Solicitudes')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Gestión de Solicitudes</h3>
                        {{-- <a href="{{ route('solicitudes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nueva Solicitud
                    </a> --}}
                    </div>

                    <div class="card-body">
                        <!-- Filtros -->
                        <form method="GET" action="/solicitud" class="row mb-4">
                            <div class="col-md-2">
                                <input type="text" name="numero_cuenta" class="form-control"
                                    placeholder="Número de cuenta" value="{{ request('numero_cuenta') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="user_id" class="form-control">
                                    <option value="">Todos los usuarios</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}"
                                            {{ request('user_id') == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->nombres_apellidos ?? $usuario->correo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="tipo_solicitud" class="form-control">
                                    <option value="">Todos los tipos</option>
                                    @foreach ($tiposSolicitud as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ request('tipo_solicitud') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="estado_solicitud" class="form-control">
                                    <option value="">Todos los estados</option>
                                    @foreach ($estadosSolicitud as $estado)
                                        <option value="{{ $estado->id }}"
                                            {{ request('estado_solicitud') == $estado->id ? 'selected' : '' }}>
                                            {{ $estado->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="banco_id" class="form-control">
                                    <option value="">Todos los bancos</option>
                                    @foreach ($bancos as $banco)
                                        <option value="{{ $banco->id }}"
                                            {{ request('banco_id') == $banco->id ? 'selected' : '' }}>
                                            {{ $banco->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="/solicitud" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </form>

                        <!-- Mensajes -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Tabla de solicitudes -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Banco</th>
                                        <th>Número Cuenta</th>
                                        <th>Monto</th>
                                        <th>Evidencia</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->sub_id }}</td>
                                            <td>
                                                {{ $solicitud->user->nombres_apellidos ?? '' }} <br>
                                                {{ $solicitud->user->correo ?? '' }}

                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-info">{{ $solicitud->tipoSolicitud->nombre ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $estadoClass = match ($solicitud->estadoSolicitud->id ?? 0) {
                                                        1 => 'bg-warning text-dark', // Pendiente
                                                        2 => 'bg-success', // Aprobada
                                                        3 => 'bg-danger', // Rechazada
                                                        4 => 'bg-primary', // En Proceso
                                                        default => 'bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $estadoClass }}">
                                                    {{ $solicitud->estadoSolicitud->nombre ?? 'N/A' }}
                                                </span>
                                                @if ($solicitud->estadoSolicitud->id == 3 && $solicitud->motivo_rechazo)
                                                    <br><small class="text-danger"
                                                        title="{{ $solicitud->motivo_rechazo }}">
                                                        <i class="fas fa-info-circle"></i> Ver motivo
                                                    </small>
                                                @endif
                                            </td>
                                            <td>{{ $solicitud->banco->nombre ?? 'N/A' }}</td>
                                            <td>{{ $solicitud->numero_cuenta ?? 'N/A' }}</td>
                                            <td>
                                                @if ($solicitud->monto)
                                                    <span
                                                        class="fw-bold text-success">${{ number_format($solicitud->monto, 2) }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($solicitud->evidencia_file)
                                                    <a href="{{ route('solicitudes.descargar-evidencia', $solicitud) }}"
                                                        class="btn btn-sm btn-outline-primary" target="_blank"
                                                        title="Descargar {{ basename($solicitud->evidencia_file) }}">
                                                        <i class="fas fa-download"></i>
                                                        @php
                                                            $extension = pathinfo(
                                                                $solicitud->evidencia_file,
                                                                PATHINFO_EXTENSION,
                                                            );
                                                            $icon = match (strtolower($extension)) {
                                                                'pdf' => 'fa-file-pdf',
                                                                'jpg', 'jpeg', 'png', 'gif' => 'fa-file-image',
                                                                'doc', 'docx' => 'fa-file-word',
                                                                default => 'fa-file',
                                                            };
                                                        @endphp
                                                        <i class="fas {{ $icon }}"></i>
                                                    </a>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-times-circle"></i> Sin evidencia
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    {{ $solicitud->created_at->format('d/m/Y') }}<br>
                                                    <span
                                                        class="text-muted">{{ $solicitud->created_at->format('H:i') }}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    {{-- <a href="{{ route('solicitudes.show', $solicitud) }}"
                                                   class="btn btn-sm btn-info" title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}

                                                    <a href="{{ route('solicitud.edit', $solicitud) }}"
                                                        class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('usuarios.editSaldoUser', ['usuario' => $solicitud->user->id, 'solicitud' => $solicitud->id]) }}"
                                                        class="btn btn-sm btn-success" title="Editar saldo">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </a>


                                                    {{-- <form action="{{ route('solicitudes.destroy', $solicitud) }}"
                                                      method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Eliminar"
                                                            onclick="return confirm('¿Está seguro de eliminar esta solicitud?\n\nEsta acción no se puede deshacer.')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                                    <h5>No se encontraron solicitudes</h5>
                                                    <p class="mb-0">No hay solicitudes que coincidan con los criterios de
                                                        búsqueda.</p>
                                                    {{-- <a href="{{ route('solicitud.create') }}"
                                                        class="btn btn-primary mt-3">
                                                        <i class="fas fa-plus"></i> Crear primera solicitud
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Información adicional -->
                        @if ($solicitudes->count() > 0)
                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $solicitudes->count() }}</h4>
                                            <p class="mb-0">Total Solicitudes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-warning text-dark">
                                        <div class="card-body text-center">
                                            <h4>{{ $solicitudes->where('estado_solicitud', 1)->count() }}</h4>
                                            <p class="mb-0">Pendientes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $solicitudes->where('estado_solicitud', 2)->count() }}</h4>
                                            <p class="mb-0">Aprobadas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-danger text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $solicitudes->where('estado_solicitud', 3)->count() }}</h4>
                                            <p class="mb-0">Rechazadas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th {
            font-weight: 600;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
            font-weight: 500;
        }

        .btn-group .btn {
            margin-right: 2px;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .form-control {
            font-size: 0.875rem;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        .card-body .card {
            transition: transform 0.2s ease-in-out;
        }

        .card-body .card:hover {
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .btn-group {
                display: flex;
                flex-direction: column;
            }

            .btn-group .btn {
                margin-right: 0;
                margin-bottom: 2px;
            }

            .table th,
            .table td {
                font-size: 0.8rem;
                padding: 0.5rem;
            }
        }

        /* Estado tooltips */
        [title] {
            cursor: help;
        }

        /* Loading animation for filters */
        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form cuando cambian los filtros
            const filterSelects = document.querySelectorAll('select[name]');
            filterSelects.forEach(select => {
                select.addEventListener('change', function() {
                    // Opcional: auto-submit cuando cambia un filtro
                    // this.closest('form').submit();
                });
            });

            // Tooltip para motivos de rechazo
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                }
            });

            // Confirmación mejorada para eliminar
            const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm(
                            '¿Está seguro de eliminar esta solicitud?\n\nEsta acción eliminará:\n- La solicitud\n- Sus archivos de evidencia\n\nEsta acción no se puede deshacer.'
                        )) {
                        this.closest('form').submit();
                    }
                });
                // Remover el onclick inline
                button.removeAttribute('onclick');
            });
        });
    </script>
@endsection
