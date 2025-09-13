@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Detalle del Producto</h1>
                    <div>
                        <a href="{{ route('tienda.edit', $tienda) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('tienda.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Imagen del Producto</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($tienda->img_url)
                                    <img src="{{ asset('storage/' . $tienda->img_url) }}" alt="{{ $tienda->nombre }}"
                                        class="img-fluid rounded shadow" style="max-height: 400px;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                                        style="height: 300px;">
                                        <div class="text-center">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <p class="mb-0">Sin imagen disponible</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Información del Producto</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">ID:</td>
                                            <td>{{ $tienda->id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Nombre:</td>
                                            <td>{{ $tienda->nombre }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Precio:</td>
                                            <td class="text-success fw-bold">${{ number_format($tienda->precio, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Stock:</td>
                                            <td>
                                                <span
                                                    class="badge {{ $tienda->cantidad > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                                    {{ $tienda->cantidad }} unidades
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Estado:</td>
                                            <td>
                                                @if ($tienda->cantidad > 10)
                                                    <span class="badge bg-success">En Stock</span>
                                                @elseif($tienda->cantidad > 0)
                                                    <span class="badge bg-warning">Stock Bajo</span>
                                                @else
                                                    <span class="badge bg-danger">Agotado</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Creado:</td>
                                            <td>{{ $tienda->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Última actualización:</td>
                                            <td>{{ $tienda->updated_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Acciones</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('tienda.edit', $tienda) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Editar Producto
                                    </a>
                                    <form action="{{ route('tienda.destroy', $tienda) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fas fa-trash"></i> Eliminar Producto
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
