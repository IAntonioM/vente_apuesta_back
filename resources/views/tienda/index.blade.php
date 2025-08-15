@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Tienda</h1>
                    <a href="{{ route('tienda.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Búsqueda por nombre -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('tienda.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="nombre"
                                       placeholder="Buscar producto por nombre..." value="{{ request('nombre') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                @if(request('nombre'))
                                    <a href="{{ route('tienda.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    @if(request('nombre'))
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end align-items-center">
                                <span class="badge bg-primary">
                                    Filtrado por: "{{ request('nombre') }}"
                                    <a href="{{ route('tienda.index') }}" class="text-white ms-1" title="Limpiar filtro">
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
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Creado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>
                                                @if ($producto->img_url)
                                                    <img src="{{ asset($producto->img_url) }}" alt="{{ $producto->nombre }}"
                                                        class="img-thumbnail"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                        style="width: 50px; height: 50px; border-radius: 0.375rem;">
                                                        Sin imagen
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>${{ number_format($producto->precio, 2) }}</td>
                                            <td>
                                                <span class="badge {{ $producto->cantidad > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $producto->cantidad }}
                                                </span>
                                            </td>
                                            <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tienda.show', $producto) }}"
                                                        class="btn btn-info btn-sm text-white" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('tienda.edit', $producto) }}"
                                                        class="btn btn-warning btn-sm text-dark" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('tienda.destroy', $producto) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                @if(request('nombre'))
                                                    No se encontraron productos con el nombre "{{ request('nombre') }}"
                                                    <br>
                                                    <a href="{{ route('tienda.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                                        Ver todos los productos
                                                    </a>
                                                @else
                                                    No hay productos registrados
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Sin paginación, se muestran todos los productos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
