@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-criar-role.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Criar Novo Papél</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Erro!</strong>
                <span class="block sm:inline">Houve um problema com a entrada de dados.</span>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium">Nome do Papél</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Nome da Função" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Permissões</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach($permission as $value)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permission[{{ $value->id }}]" value="{{ $value->id }}" class="form-checkbox text-blue-600">
                            <span class="text-gray-800">{{ $value->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar
                </button>
                <a href="{{ route('roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    <i class="fa fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
