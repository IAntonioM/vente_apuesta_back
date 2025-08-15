<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap CSS desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Si tienes un CSS propio --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <div>
                @auth
                    <a href="{{ route('principal') }}" class="btn btn-outline-light me-2">Principal</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Salir</button>
                    </form>
                @else
                    {{-- <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a> --}}
                @endauth
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Si tienes un JS propio --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    @livewireScripts
</body>
</html>
