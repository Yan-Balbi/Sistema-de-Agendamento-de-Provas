@extends('layouts.app')
</style>
@section('content')

<script>
    function getById(button) {
        var id = button.getAttribute("data-id");
        console.log("ID do Professor: " + id);
        window.location.href = "{{ route('professor.edit', '') }}" + "/" + id;
    }
    function confirmDelete(event) {
        event.preventDefault(); // Impede o envio automático do formulário

        let confirmation = confirm("Tem certeza que deseja apagar este professor?");
        
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
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Professores</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">Nome do Professor</th>
                    <th class="p-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professores as $professor)
                <tr class="bg-white border-b hover:bg-gray-100 transition">

                    <td class="p-3 text-green-600 min-w-[600px]">{{ $professor->nome }}</td>
                    <td class="p-3">
                        <div class="div-botoes">
                            <button class="btn visualizar" data-id="{{ $professor->id }}" onclick="getById(this)"> Visualizar </button>

                            <form method="POST" action="{{ route('professor.destroy', $professor->id) }}">
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
            {{ $professores->links() }}
        </ul>
    </nav>
</tbody>
@endsection
</div>
