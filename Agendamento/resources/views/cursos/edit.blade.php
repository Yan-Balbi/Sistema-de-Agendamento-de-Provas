@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-editar-curso.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Editar Curso</h1>

        <form action="{{ route('cursos.update', $curso->id) }}" method="POST" class="flex flex-col space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="text-gray-700 font-semibold">Nome:</label>
                <input type="text" name="nome" value="{{ $curso->nome }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out focus:outline-none">
            </div>

            <div>
                <label class="text-gray-700 font-semibold">Descrição:</label>
                <input type="text" name="descricao" value="{{ $curso->descricao }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-300 ease-in-out focus:outline-none">
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Salvar</button>
                <a href="{{ route('cursos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
