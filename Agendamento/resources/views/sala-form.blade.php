@include('header')
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Layout</title>

    <link rel="stylesheet" href="{{ url('CSS/estilos-header.css') }}">
    <script>
        function redirectToSala() {

            window.location.href = "{{ route('salas.create') }}";

        }
    </script>
</head>

<body>
    <div>
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <label>Nome da sala</label>
        <form method="POST" action="{{ route('salas.store') }}">
            @csrf
            <div>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome da sala" required>
            </div>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>

@include('footer')
