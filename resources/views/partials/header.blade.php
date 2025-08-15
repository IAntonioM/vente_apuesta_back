<nav class="navbar navbar-light bg-light shadow-sm mb-4">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-text">
            Bienvenido, <strong>{{ Auth::user()->nombres_apellidos }}</strong>
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Salir</button>
        </form>
    </div>
</nav>
