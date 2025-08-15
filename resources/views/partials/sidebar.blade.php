<div class="sidebar p-3">
    {{-- Logo / Nombre --}}
    <h3 class="text-white text-center mb-4">Venta y Apuestas</h3>

    <ul class="nav flex-column">
        {{-- Principal --}}
        <li class="nav-item mb-2">
            <a href="{{ route('principal') }}" class="nav-link text-white">🏠 Principal</a>
        </li>

        {{-- Ventas --}}
        <li class="nav-item mb-2">
            <a href="/tienda" class="nav-link text-white">🛒 Tienda</a>

        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a href="/usuarios" class="nav-link text-white">👥 Usuarios</a>
        </li>
    </ul>
</div>
