@extends('layouts.app')
@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-cadastro-sala.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <label class="text-xl font-semibold text-gray-800">Nome da sala</label>
        <form method="POST" action="{{ route('salas.store') }}" class="flex flex-col flex space-y-5">
            @csrf
            <div>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome da sala" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out focus:outline-none">
            </div>
            <div>
                <button type="submit" class="btn cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
@endsection
