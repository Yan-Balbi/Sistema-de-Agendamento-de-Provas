@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/tabela-turmas.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Lista de Turmas</h1>
        <a href="{{ route('turmas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Adicionar Turma</a>

        @if (session('success'))
            <p class="bg-green-100 border-l-4 border-green-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('success') }}</p>
        @endif

        <table class="w-full border-collapse mt-4">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm border-b">
                    <th class="p-3">Nome</th>
                    <th class="p-3">Curso</th>
                    <th class="p-3">Professores</th>
                    <th class="p-3">Disciplinas</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turmas as $turma)
                    <tr class="bg-white border-b hover:bg-gray-100 transition">
                        <td class="p-3 text-green-600">{{ $turma->nome }}</td>
                        <td class="p-3">{{ $turma->curso->nome }}</td>
                        <td class="p-3">
                            @foreach ($turma->professors as $professor)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">{{ $professor->nome }}</span>
                            @endforeach
                        </td>
                        <td class="p-3">
                            @foreach ($turma->disciplinas as $disciplina)
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2 py-1 rounded">{{ $disciplina->nome }}</span>
                            @endforeach
                        </td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('turmas.edit', $turma) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-sm">Editar</a>
                            <form action="{{ route('turmas.destroy', $turma) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
