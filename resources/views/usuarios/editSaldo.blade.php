@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestionar Saldo de Usuario</h1>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Información del Usuario</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombres y Apellidos</label>
                                    <input type="text" class="form-control" value="{{ $usuario->nombres_apellidos }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Correo Electrónico</label>
                                    <input type="email" class="form-control" value="{{ $usuario->correo }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Teléfono</label>
                                    <input type="text" class="form-control" value="{{ $usuario->cel }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Saldo Actual</label>
                                    <input type="text" class="form-control bg-light"
                                           value="S/ {{ number_format($usuario->saldoUsuario->saldo ?? 0, 2) }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Registrar Transacción Manual</h5>
                        @if($solicitudData)
                            <small class="text-muted">Datos precargados desde la solicitud #{{ $solicitudData->sub_id }}</small>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('usuarios.updateSaldoUser', $usuario) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if($solicitudData)
                                <input type="hidden" name="solicitudId" value="{{ $solicitudData->id }}">
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo de Transacción *</label>
                                        <select class="form-select @error('tipo') is-invalid @enderror"
                                                id="tipo" name="tipo" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="DEPOSITO"
                                                {{ old('tipo', $solicitudData && $solicitudData->tipo_solicitud == 2 ? 'DEPOSITO' : '') == 'DEPOSITO' ? 'selected' : '' }}>
                                                DEPÓSITO (Aumenta saldo)
                                            </option>
                                            <option value="RETIRO"
                                                {{ old('tipo', $solicitudData && $solicitudData->tipo_solicitud == 1 ? 'RETIRO' : '') == 'RETIRO' ? 'selected' : '' }}>
                                                RETIRO (Disminuye saldo)
                                            </option>
                                        </select>
                                        @error('tipo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="monto" class="form-label">Monto *</label>
                                        <input type="text"
                                               class="form-control @error('monto') is-invalid @enderror"
                                               id="monto" name="monto"
                                               value="{{ old('monto', $solicitudData->monto ?? '') }}"
                                               placeholder="0.00" required>
                                        @error('monto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="referencia" class="form-label">Referencia *</label>
                                        <input type="text"
                                               class="form-control @error('referencia') is-invalid @enderror"
                                               id="referencia" name="referencia"
                                               value="{{ old('referencia', $solicitudData ? 'Solicitud #' . $solicitudData->sub_id . ' - Cuenta: ' . $solicitudData->numero_cuenta : '') }}"
                                               placeholder="Ej: Ajuste manual, Operación #12345" required>
                                        @error('referencia')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="metodo_pago" class="form-label">Método de Pago *</label>
                                        <input type="text"
                                               class="form-control @error('metodo_pago') is-invalid @enderror"
                                               id="metodo_pago" name="metodo_pago"
                                               value="{{ old('metodo_pago', $solicitudData && $solicitudData->banco ? $solicitudData->banco->nombre : '') }}"
                                               placeholder="Ej: Transferencia, Efectivo, Yape" required>
                                        @error('metodo_pago')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="observacion" class="form-label">Observación</label>
                                        <textarea class="form-control @error('observacion') is-invalid @enderror"
                                                  id="observacion" name="observacion"
                                                  rows="3" placeholder="Observaciones adicionales (opcional)">{{ old('observacion', $solicitudData->descripcion ?? '') }}</textarea>
                                        @error('observacion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle"></i>
                                <strong>Nota:</strong> Esta transacción será registrada como APROBADA y afectará inmediatamente el saldo del usuario.
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Registrar Transacción
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
