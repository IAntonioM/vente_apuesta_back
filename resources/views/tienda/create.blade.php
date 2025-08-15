@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Agregar Producto</h1>
                <a href="{{ route('tienda.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tienda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           id="nombre"
                                           name="nombre"
                                           value="{{ old('nombre') }}"
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
                                               value="{{ old('precio') }}"
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
                                           value="{{ old('cantidad') }}"
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
                                           accept="image/*"
                                           required>
                                    <div class="form-text">Formatos permitidos: JPG, JPEG, PNG, GIF. Máximo 2MB.</div>
                                    @error('imagen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="preview" class="form-label">Vista previa</label>
                            <div id="preview-container" class="d-none">
                                <img id="image-preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Producto
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
