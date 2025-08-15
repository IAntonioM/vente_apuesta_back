@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Editar Producto: {{ $tienda->nombre }}</h1>
                <a href="{{ route('tienda.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tienda.update', $tienda) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           id="nombre"
                                           name="nombre"
                                           value="{{ old('nombre', $tienda->nombre) }}"
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number"
                                               step="0.01"
                                               min="0"
                                               class="form-control @error('precio') is-invalid @enderror"
                                               id="precio"
                                               name="precio"
                                               value="{{ old('precio', $tienda->precio) }}"
                                               required>
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad en Stock</label>
                                    <input type="number"
                                           min="0"
                                           class="form-control @error('cantidad') is-invalid @enderror"
                                           id="cantidad"
                                           name="cantidad"
                                           value="{{ old('cantidad', $tienda->cantidad) }}"
                                           required>
                                    @error('cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">Imagen del Producto</label>
                                    <input type="file"
                                           class="form-control @error('imagen') is-invalid @enderror"
                                           id="imagen"
                                           name="imagen"
                                           accept="image/*">
                                    <div class="form-text">Formatos permitidos: JPG, JPEG, PNG, GIF. Máximo 2MB. (Opcional - deja vacío para mantener la imagen actual)</div>
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Imagen Actual</label>
                                    <div>
                                        @if($tienda->img_url)
                                            <img src="{{ asset($tienda->img_url) }}"
                                                 alt="{{ $tienda->nombre }}"
                                                 class="img-thumbnail"
                                                 style="max-width: 200px; max-height: 200px;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                 style="width: 200px; height: 200px; border-radius: 0.375rem;">
                                                Sin imagen
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="preview" class="form-label">Nueva Imagen (Vista previa)</label>
                                    <div id="preview-container" class="d-none">
                                        <img id="image-preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar Producto
                            </button>
                            <a href="{{ route('tienda.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('d-none');
    }
});
</script>
@endsection
