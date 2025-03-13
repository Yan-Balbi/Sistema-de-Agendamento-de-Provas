@extends('layouts.app')
</style>
@section('content')

<script>
    function getById(button) {
        var id = button.getAttribute("data-id");
        console.log("ID da sala: " + id);
        window.location.href = "{{ route('agendamentos.edit', '') }}" + "/" + id;
    }
</script>

<head>
    <link rel="stylesheet" href="{{ asset('CSS/tabela-salas.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('danger'))
        <p class="bg-red-100 border-l-4 border-red-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('danger') }}</p>
    @endif
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Agendamentos</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">Agendamento</th>
                    <th class="p-3">Data</th>
                    <th class="p-3">Sala</th>
                    <th class="p-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendamentos as $agendamento)
                <tr class="bg-white border-b hover:bg-gray-100 transition">

                    <td class="p-3 text-green-600 min-w-[10px]">Avaliação de {{  $agendamento->disciplina->nome  }} </td>
                    <td class="p-3 text-green-600 min-w-[10px]"> {{ $agendamento->data }} </td>
                    <td class="p-3 text-green-600 min-w-[10px]"> {{ $agendamento->sala->nome }} </td>
                    <td class="p-3">
                        <div class="div-botoes">
                            <button class="btn visualizar" data-id="{{ $agendamento->id }}" onclick="getById(this)"> Visualizar </button>

                            <form method="POST" action="{{ route('agendamento.destroy', $agendamento->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn apagar" type="submit"> Apagar </button>
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
            {{ $agendamentos->links() }}
        </ul>
    </nav>
</tbody>
@endsection
</div>
