<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('CSS/estilos-header.css') }}" />
    <script>
        function redirectToCadastroSala() {
            window.location.href = "{{ route('salas.create') }}";
        }

        function redirectToListagemSala() {
            window.location.href = "{{ route('salas.index') }}";
        }
    </script>

    <!-- Styles -->
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        <header>
        @include('layouts.navbar')
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <footer>
            @include('layouts.footer')
        </footer>
    </div>

</body>

</html>
