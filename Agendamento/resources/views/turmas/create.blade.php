@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-adicionar-turma.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Adicionar Nova Turma</h1>

        <form action="{{ route('turmas.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nome" class="block text-gray-700 font-medium">Nome da Turma</label>
                <input type="text" name="nome" id="nome" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div>
                <label for="curso_id" class="block text-gray-700 font-medium">Curso</label>
                <select name="curso_id" id="curso_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="professors" class="block text-gray-700 font-medium">Professores</label>
                <select name="professors[]" id="professors" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" multiple required>
                    @foreach ($professors as $professor)
                        <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="disciplinas" class="block text-gray-700 font-medium">Disciplinas</label>
                <select name="disciplinas[]" id="disciplinas" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" multiple required>
                    @foreach ($disciplinas as $disciplina)
                        <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Salvar</button>
                <a href="{{ route('turmas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
