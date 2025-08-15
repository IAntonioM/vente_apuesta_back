<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
        }
        .content {
            flex-grow: 1;
            background-color: #f8f9fa;
            padding: 20px;
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="content d-flex flex-column">
        {{-- Header --}}
        @include('partials.header')

        {{-- Contenido dinámico --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
