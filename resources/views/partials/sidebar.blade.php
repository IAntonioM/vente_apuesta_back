<div class="sidebar p-3 bg-dark h-100">
    {{-- Logo / Nombre --}}
    <h3 class="text-white text-center mb-4 fw-bold">Venta y Apuestas</h3>

    <ul class="nav flex-column">
        {{-- Principal --}}
        <li class="nav-item mb-2">
            <a href="{{ route('principal') }}"
                class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <span class="me-2">🏠</span> Principal
            </a>
        </li>

        {{-- Ventas --}}
        <li class="nav-item mb-2">
            <a href="/tienda" class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <span class="me-2">🛒</span> Tienda
            </a>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item mb-2">
            <a href="/usuarios" class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <span class="me-2">👥</span> Usuarios
            </a>
        </li>

        {{-- Solicitudes --}}
        <li class="nav-item mb-2">
            <a href="/solicitud" class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <span class="me-2">📑</span> Solicitudes
            </a>
        </li>

        {{-- Términos y Condiciones --}}
        <li class="nav-item">
            <a href="/editar-terminos" class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <span class="me-2">📜</span> Términos y Condiciones
            </a>
        </li>

        {{-- Términos y Condiciones --}}
        <li class="nav-item">
            <a href="/configuraciones" class="nav-link text-white rounded px-3 py-2 d-flex align-items-center hover-bg">
                <i class="fas fa-cog me-2"></i> Configuraciones
            </a>
        </li>

    </ul>
</div>

<style>
    .hover-bg:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.2s ease-in-out;
    }
</style>
