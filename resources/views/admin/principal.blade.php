@extends('layouts.admin')

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
                                <option value="DEPOSITO" {{ request('tipo') == 'DEPOSITO' ? 'selected' : '' }}>Depósitos
                                </option>
                                <option value="RETIRO" {{ request('tipo') == 'RETIRO' ? 'selected' : '' }}>Retiros</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="TODOS" {{ request('estado') == 'TODOS' ? 'selected' : '' }}>Todos</option>
                                <option value="PENDIENTE" {{ request('estado') == 'PENDIENTE' ? 'selected' : '' }}>
                                    Pendiente</option>
                                <option value="APROBADO" {{ request('estado') == 'APROBADO' ? 'selected' : '' }}>Aprobado
                                </option>
                                <option value="RECHAZADO" {{ request('estado') == 'RECHAZADO' ? 'selected' : '' }}>
                                    Rechazado</option>
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



        <!-- Tabla de transacciones con solicitudes -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Lista de Transacciones y Solicitudes
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
                                    <th>Estado Transacción</th>
                                    <th>Estado Solicitud</th>
                                    <th>Descripción</th>
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
                                            @if ($transaccion->solicitud)
                                                @switch($transaccion->solicitud->estado_solicitud)
                                                    @case(1)
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-clock"></i>
                                                            {{ $transaccion->solicitud->estado->nombre }}
                                                        </span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check"></i>
                                                            {{ $transaccion->solicitud->estado->nombre }}
                                                        </span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times"></i>
                                                            {{ $transaccion->solicitud->estado->nombre }}
                                                        </span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge bg-info">
                                                            <i class="fas fa-cog fa-spin"></i>
                                                            {{ $transaccion->solicitud->estado->nombre }}
                                                        </span>
                                                    @break
                                                @endswitch
                                                @if ($transaccion->solicitud->motivo_rechazo)
                                                    <br><small class="text-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        {{ Str::limit($transaccion->solicitud->motivo_rechazo, 30) }}
                                                    </small>
                                                @endif
                                            @else
                                                <span class="text-muted">Sin solicitud</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaccion->solicitud)
                                                <small class="text-muted">
                                                    {{ Str::limit($transaccion->solicitud->descripcion, 40) }}
                                                </small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>
                                                {{ $transaccion->created_at->format('d/m/Y') }}<br>
                                                {{ $transaccion->created_at->format('H:i:s') }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($transaccion->solicitud && !in_array($transaccion->solicitud->estado_solicitud, [2, 3]))
                                                <!-- Solo mostrar botón editar si la solicitud NO está aprobada (2) o rechazada (3) -->
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    onclick="abrirModalEditar({{ $transaccion->solicitud->id }}, '{{ $transaccion->metodo_pago }}', {{ $transaccion->solicitud->estado_solicitud }}, '{{ $transaccion->solicitud->motivo_rechazo }}')"
                                                    title="Editar Solicitud">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
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

        <!-- Modal para rechazar solicitud -->
        <!-- Modal para editar solicitud -->
        <div class="modal fade" id="modalEditarSolicitud" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">
                            <i class="fas fa-edit"></i> Editar Solicitud
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarSolicitud">
                            <div class="form-group">
                                <label for="metodoPago" class="font-weight-bold">
                                    Método de Pago
                                </label>
                                <input type="text" class="form-control" id="metodoPago"
                                    style="background-color: #f8f9fa;" />
                            </div>

                            <div class="form-group">
                                <label for="estadoSolicitud" class="font-weight-bold">
                                    Estado de la Solicitud <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="estadoSolicitud" name="estado_solicitud" required>
                                    <option value="1">Pendiente</option>
                                    <option value="2">Aprobada</option>
                                    <option value="3">Rechazada</option>
                                    <option value="4">En Proceso</option>
                                </select>
                            </div>

                            <div class="form-group" id="grupoMotivoRechazo" style="display: none;">
                                <label for="motivoRechazoEditar" class="font-weight-bold">
                                    Motivo del rechazo <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="motivoRechazoEditar" name="motivo_rechazo" rows="4" maxlength="500"
                                    placeholder="Explique detalladamente el motivo del rechazo..."></textarea>
                                <small class="form-text text-muted">
                                    Máximo 500 caracteres. <span id="contadorCaracteresEditar">0/500</span>
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="btnGuardarCambios">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            let solicitudIdParaEditar = null;

            // Función para abrir modal de editar
            function abrirModalEditar(solicitudId, metodoPago, estadoActual, motivoRechazo) {
                solicitudIdParaEditar = solicitudId;

                // Llenar los campos del modal
                $('#metodoPago').val(metodoPago);
                $('#estadoSolicitud').val(estadoActual);
                $('#motivoRechazoEditar').val(motivoRechazo || '');

                // Mostrar u ocultar el campo de motivo según el estado
                toggleMotivoRechazo(estadoActual);

                // Actualizar contador de caracteres
                actualizarContadorCaracteres();

                $('#modalEditarSolicitud').modal('show');
                console.log("Se abrió el modal editar");
            }

            // Función para mostrar/ocultar motivo de rechazo
            function toggleMotivoRechazo(estado) {
                if (estado == 3) { // Rechazada
                    $('#grupoMotivoRechazo').show();
                    $('#motivoRechazoEditar').prop('required', true);
                } else {
                    $('#grupoMotivoRechazo').hide();
                    $('#motivoRechazoEditar').prop('required', false);
                    $('#motivoRechazoEditar').val('');
                    // Actualizar contador cuando se limpia
                    actualizarContadorCaracteres();
                }
            }

            // Evento para cambio de estado
            $(document).on('change', '#estadoSolicitud', function() {
                const estadoSeleccionado = $(this).val();
                toggleMotivoRechazo(estadoSeleccionado);
            });

            // Contador de caracteres para el textarea del modal editar
            $(document).on('input', '#motivoRechazoEditar', function() {
                actualizarContadorCaracteres();
            });

            function actualizarContadorCaracteres() {
                const maxLength = 500;
                const currentLength = $('#motivoRechazoEditar').val().length;
                $('#contadorCaracteresEditar').text(currentLength + '/' + maxLength);

                if (currentLength >= maxLength) {
                    $('#contadorCaracteresEditar').addClass('text-danger');
                } else {
                    $('#contadorCaracteresEditar').removeClass('text-danger');
                }
            }

            // Guardar cambios
            $(document).on('click', '#btnGuardarCambios', function() {
                const estadoSeleccionado = $('#estadoSolicitud').val();
                const motivoRechazo = $('#motivoRechazoEditar').val().trim();

                // Validar si es rechazada y no hay motivo
                if (estadoSeleccionado == 3 && !motivoRechazo) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo requerido',
                        text: 'Por favor, ingrese el motivo del rechazo.',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                // Confirmar la acción
                let textoConfirmacion = '';
                let textoExito = '';

                switch (estadoSeleccionado) {
                    case '1':
                        textoConfirmacion = '¿Desea marcar esta solicitud como "Pendiente"?';
                        textoExito = 'Solicitud marcada como "Pendiente"';
                        break;
                    case '2':
                        textoConfirmacion = '¿Está seguro de aprobar esta solicitud?';
                        textoExito = 'Solicitud aprobada correctamente';
                        break;
                    case '3':
                        textoConfirmacion = '¿Está seguro de rechazar esta solicitud?';
                        textoExito = 'Solicitud rechazada correctamente';
                        break;
                    case '4':
                        textoConfirmacion = '¿Desea marcar esta solicitud como "En Proceso"?';
                        textoExito = 'Solicitud marcada como "En Proceso"';
                        break;
                }

                Swal.fire({
                    title: 'Confirmar cambios',
                    text: textoConfirmacion,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        enviarCambiosSolicitud(solicitudIdParaEditar, estadoSeleccionado, motivoRechazo,
                            textoExito);
                    }
                });
            });

            // Función para enviar los cambios al servidor
            function enviarCambiosSolicitud(solicitudId, estado, motivo, textoExito) {
                // Cerrar modal
                $('#modalEditarSolicitud').modal('hide');

                // Mostrar loading
                Swal.fire({
                    title: 'Procesando...',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                const data = {
                    estado_solicitud: estado,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                if (estado == 3 && motivo) {
                    data.motivo_rechazo = motivo;
                }

                $.ajax({
                    url: '/admin/solicitudes/' + solicitudId + '/actualizar',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: textoExito,
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Ha ocurrido un error inesperado',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function(xhr) {
                        let mensaje = 'Ha ocurrido un error en el servidor';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            mensaje = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            mensaje = Object.values(xhr.responseJSON.errors).flat().join(', ');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: mensaje,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            }
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
