@extends('layouts.app')

@section('title', 'Editar Solicitud')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Editar Solicitud #{{ $solicitud->id }}</h3>
                    <a href="{{ route('solicitud.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('solicitud.update', $solicitud) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Información del usuario -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="user_id" class="form-label">Usuario</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Seleccionar usuario...</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}" {{ old('user_id', $solicitud->user_id) == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->nombres_apellidos ?? '' }} - {{ $usuario->correo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tipo de solicitud -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tipo_solicitud" class="form-label">Tipo de Solicitud <span class="text-danger">*</span></label>
                                    <select name="tipo_solicitud" id="tipo_solicitud" class="form-control" required>
                                        <option value="">Seleccionar tipo...</option>
                                        @foreach($tiposSolicitud as $tipo)
                                            <option value="{{ $tipo->id }}" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Estado de solicitud -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="estado_solicitud" class="form-label">Estado <span class="text-danger">*</span></label>
                                    <select name="estado_solicitud" id="estado_solicitud" class="form-control" required>
                                        <option value="">Seleccionar estado...</option>
                                        @foreach($estadosSolicitud as $estado)
                                            <option value="{{ $estado->id }}"
                                                    {{ old('estado_solicitud', $solicitud->estado_solicitud) == $estado->id ? 'selected' : '' }}
                                                    data-estado="{{ $estado->nombre }}">
                                                {{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Banco -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="banco_id" class="form-label">Banco</label>
                                    <select name="banco_id" id="banco_id" class="form-control">
                                        <option value="">Seleccionar banco...</option>
                                        @foreach($bancos as $banco)
                                            <option value="{{ $banco->id }}" {{ old('banco_id', $solicitud->banco_id) == $banco->id ? 'selected' : '' }}>
                                                {{ $banco->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Número de cuenta -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="numero_cuenta" class="form-label">Número de Cuenta</label>
                                    <input type="text" name="numero_cuenta" id="numero_cuenta"
                                           class="form-control" value="{{ old('numero_cuenta', $solicitud->numero_cuenta) }}"
                                           maxlength="50" placeholder="Ingrese número de cuenta">
                                </div>
                            </div>

                            <!-- Monto -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="monto" class="form-label">Monto</label>
                                    <input type="number" name="monto" id="monto"
                                           class="form-control" value="{{ old('monto', $solicitud->monto) }}"
                                           step="0.01" min="0" max="99999999.99" placeholder="0.00">
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control"
                                              rows="3" maxlength="500" placeholder="Descripción de la solicitud...">{{ old('descripcion', $solicitud->descripcion) }}</textarea>
                                    <small class="form-text text-muted">Máximo 500 caracteres</small>
                                </div>
                            </div>

                            <!-- Motivo de rechazo (se muestra condicionalmente) -->
                            <div class="col-12" id="motivo-rechazo-container" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="motivo_rechazo" class="form-label">Motivo de Rechazo <span class="text-danger">*</span></label>
                                    <textarea name="motivo_rechazo" id="motivo_rechazo" class="form-control"
                                              rows="3" maxlength="500" placeholder="Ingrese el motivo del rechazo...">{{ old('motivo_rechazo', $solicitud->motivo_rechazo) }}</textarea>
                                    <small class="form-text text-muted">Requerido cuando el estado es "Rechazada"</small>
                                </div>
                            </div>

                            <!-- Evidencia actual -->
                            @if($solicitud->evidencia_file)
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Evidencia Actual</label>
                                        <div class="d-flex align-items-center">
                                            <span class="me-3">{{ basename($solicitud->evidencia_file) }}</span>
                                            <a href="{{ route('solicitudes.descargar-evidencia', $solicitud) }}"
                                               class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-download"></i> Descargar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Nueva evidencia -->
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="evidencia_file" class="form-label">
                                        {{ $solicitud->evidencia_file ? 'Cambiar Evidencia' : 'Subir Evidencia' }}
                                    </label>
                                    <input type="file" name="evidencia_file" id="evidencia_file"
                                           class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <small class="form-text text-muted">
                                        Formatos permitidos: JPG, PNG, PDF, DOC, DOCX. Tamaño máximo: 10MB
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('solicitud.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Actualizar Solicitud
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado_solicitud');
    const motivoContainer = document.getElementById('motivo-rechazo-container');
    const motivoTextarea = document.getElementById('motivo_rechazo');

    function toggleMotivoRechazo() {
        const selectedOption = estadoSelect.options[estadoSelect.selectedIndex];
        const estadoNombre = selectedOption.getAttribute('data-estado');

        if (estadoNombre === 'Rechazada') {
            motivoContainer.style.display = 'block';
            motivoTextarea.required = true;
        } else {
            motivoContainer.style.display = 'none';
            motivoTextarea.required = false;
            motivoTextarea.value = ''; // Limpiar el campo si no es necesario
        }
    }

    // Ejecutar al cargar la página
    toggleMotivoRechazo();

    // Ejecutar cuando cambie el estado
    estadoSelect.addEventListener('change', toggleMotivoRechazo);

    // Validación del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const estadoSelect = document.getElementById('estado_solicitud');
        const selectedOption = estadoSelect.options[estadoSelect.selectedIndex];
        const estadoNombre = selectedOption.getAttribute('data-estado');
        const motivoRechazo = document.getElementById('motivo_rechazo').value.trim();

        if (estadoNombre === 'Rechazada' && motivoRechazo === '') {
            e.preventDefault();
            alert('Debe ingresar un motivo de rechazo cuando el estado es "Rechazada".');
            document.getElementById('motivo_rechazo').focus();
        }
    });
});
</script>

<style>
.card {
    border: none;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-label {
    font-weight: 600;
    color: #333;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

.btn {
    border-radius: 0.5rem;
    font-weight: 500;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

#motivo-rechazo-container {
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-top: 1rem;
}

#motivo-rechazo-container label {
    color: #dc2626;
}

.text-danger {
    color: #dc2626 !important;
}

.file-info {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    padding: 0.75rem;
}
</style>
@endsection
