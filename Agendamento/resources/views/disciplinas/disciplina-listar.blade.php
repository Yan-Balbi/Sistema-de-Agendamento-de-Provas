@extends('layouts.app')
</style>
@section('content')

<script>
    function getById(button) {
        var id = button.getAttribute("data-id");
        console.log("ID da Disciplina: " + id);
        window.location.href = "{{ route('disciplina.edit', '') }}" + "/" + id;
    }
    function confirmDelete(event) {
        event.preventDefault(); // Impede o envio automático do formulário

        let confirmation = confirm("Tem certeza que deseja apagar esta disciplina?");
        
        if (confirmation) {
            event.target.closest("form").submit(); // Submete o formulário se confirmado
        }
    }

</script>

<head>
    <link rel="stylesheet" href="{{ asset('CSS/tabela-salas.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    @if(session('success'))
        <p class="bg-green-100 border-l-4 border-green-500 text-black-700 p-4 mb-4 rounded-lg" style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('danger'))
        <p class="bg-red-100 border-l-4 border-red-500 text-black-700 p-4 mb-4 rounded-lg" style="color: red;">{{ session('danger') }}</p>
    @endif
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Disciplinas</h2>
        <form method="GET" action="{{ route('disciplina.listar') }}">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar Disciplina"
                value="{{ request()->input('buscar') }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out focus:outline-none">
            <button type="submit" class="btn bg-blue-500 text-white px-4 py-2 rounded mt-2">Buscar</button>
        </form> 
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">Nome do Disciplina</th>
                    <th class="p-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disciplinas as $disciplina)
                <tr class="bg-white border-b hover:bg-gray-100 transition">

                    <td class="p-3 text-green-600 min-w-[600px]">{{ $disciplina->nome }}</td>
                    <td class="p-3">
                        <div class="div-botoes">
                            <button class="btn visualizar" data-id="{{ $disciplina->id }}" onclick="getById(this)"> Visualizar </button>

                            <form method="POST" action="{{ route('disciplina.destroy', $disciplina->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn apagar" type="submit" onclick="confirmDelete(event)"> Apagar </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<tbody>
    <nav>
        <ul class="pagination pagination-sm">
            {{ $disciplinas->links() }}
        </ul>
    </nav>
</tbody>
@endsection
</div>
