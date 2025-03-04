@extends('layouts.app')
</style>
@section('content')

<script>
    function getById(button) {
        var id = button.getAttribute("data-id");
        console.log("ID da sala: " + id);
        window.location.href = "{{ route('salas.edit', '') }}" + "/" + id;
    }
</script>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<head>
    <link rel="stylesheet" href="{{ asset('CSS/tabela-salas.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Salas</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">Nome da sala</th>
                    <th class="p-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salas as $sala)
                <tr class="bg-white border-b hover:bg-gray-100 transition">

                    <td class="p-3 text-green-600">{{ $sala->nome }}</td>
                    <td class="p-3">
                    <button class="btn visualizar" data-id="{{ $sala->id }}" onclick="getById(this)"> Visualizar </button>
                        <button class="btn apagar"> Apagar </button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<tbody>
    <nav>
        <ul class="pagination pagination-sm">
            {{ $salas->links() }}
        </ul>
    </nav>
</tbody>
@endsection
</body>
