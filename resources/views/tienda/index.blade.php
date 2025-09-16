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

                <!-- Filtros -->
                <div class="row mb-3">
                    <div class="col-12">
                        <form method="GET" action="{{ route('tienda.index') }}" class="row g-3">
                            <!-- Búsqueda por nombre -->
                            <div class="col-md-3">
                                <label for="nombre" class="form-label">Buscar por nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Buscar producto..." value="{{ request('nombre') }}">
                            </div>

                            <!-- Filtro por ronda -->
                            <div class="col-md-2">
                                <label for="n_ronda" class="form-label">Filtrar por Ronda</label>
                                <select class="form-select" id="n_ronda" name="n_ronda">
                                    <option value="">Todas las rondas</option>
                                    @for ($i = 1; $i <= 15; $i++)
                                        <option value="{{ $i }}" {{ request('n_ronda') == $i ? 'selected' : '' }}>
                                            Ronda {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filtro por nivel -->
                            <div class="col-md-2">
                                <label for="nivel" class="form-label">Filtrar por Nivel</label>
                                <select class="form-select" id="nivel" name="nivel">
                                    <option value="">Todos los niveles</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ request('nivel') == $i ? 'selected' : '' }}>
                                            Nivel {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filtro por mayor/menor -->
                            <div class="col-md-3">
                                <label for="flag_mayor" class="form-label">Mayor a su Ronda</label>
                                <select class="form-select" id="flag_mayor" name="flag_mayor">
                                    <option value="">Todos</option>
                                    <option value="1" {{ request('flag_mayor') === '1' ? 'selected' : '' }}>Si</option>
                                    <option value="0" {{ request('flag_mayor') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <!-- Botones -->
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                    @if (request()->hasAny(['nombre', 'n_ronda', 'nivel', 'flag_mayor']))
                                        <a href="{{ route('tienda.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Indicadores de filtros activos -->
                @if (request()->hasAny(['nombre', 'n_ronda', 'nivel', 'flag_mayor']))
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <span class="text-muted">Filtros activos:</span>
                                @if (request('nombre'))
                                    <span class="badge bg-primary">
                                        Nombre: "{{ request('nombre') }}"
                                        <a href="{{ request()->fullUrlWithQuery(['nombre' => null]) }}" class="text-white ms-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if (request('n_ronda'))
                                    <span class="badge bg-info">
                                        Ronda: {{ request('n_ronda') }}
                                        <a href="{{ request()->fullUrlWithQuery(['n_ronda' => null]) }}" class="text-white ms-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if (request('nivel'))
                                    <span class="badge bg-warning">
                                        Nivel: {{ request('nivel') }}
                                        <a href="{{ request()->fullUrlWithQuery(['nivel' => null]) }}" class="text-white ms-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                                @if (request('flag_mayor') !== null)
                                    <span class="badge bg-success">
                                        Tipo: {{ request('flag_mayor') == '1' ? 'Mayor' : 'Menor' }}
                                        <a href="{{ request()->fullUrlWithQuery(['flag_mayor' => null]) }}" class="text-white ms-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

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
                                        <th>Ronda - Nivel</th>
                                        <th>Mayor a su ronda</th>
                                        <th>Ganancia</th>
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
                                                    <img src="{{ asset('storage/' . $producto->img_url) }}"
                                                        alt="{{ $producto->nombre }}" class="img-thumbnail"
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
                                                <span
                                                    class="badge {{ $producto->cantidad > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $producto->cantidad }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">R{{ $producto->n_ronda }}</span>
                                                <span class="badge bg-secondary">N{{ $producto->nivel }}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $producto->flag_mayor ? 'bg-warning' : 'bg-info' }}">
                                                    {{ $producto->flag_mayor ? 'Si' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($producto->ganancia)
                                                    ${{ number_format($producto->ganancia, 2) }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
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
                                            <td colspan="9" class="text-center">
                                                @if (request()->hasAny(['nombre', 'n_ronda', 'nivel', 'flag_mayor']))
                                                    No se encontraron productos con los filtros aplicados
                                                    <br>
                                                    <a href="{{ route('tienda.index') }}"
                                                        class="btn btn-sm btn-outline-primary mt-2">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
