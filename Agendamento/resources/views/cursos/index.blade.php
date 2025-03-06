@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-lista-cursos.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Lista de Cursos</h1>

        <a href="{{ route('cursos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Criar Novo Curso</a>

        <table class="w-full border-collapse mt-5">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">ID</th>
                    <th class="p-3">Nome</th>
                    <th class="p-3">Descrição</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                    <tr class="bg-white border-b hover:bg-gray-100 transition">
                        <td class="p-3">{{ $curso->id }}</td>
                        <td class="p-3 text-green-600 min-w-[200px]">{{ $curso->nome }}</td>
                        <td class="p-3 min-w-[300px]">{{ $curso->descricao }}</td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">Editar</a>
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
