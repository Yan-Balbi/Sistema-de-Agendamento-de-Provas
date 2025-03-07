@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-criar-usuario.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Criar Novo Usuário</h1>

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

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium">Nome</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Nome" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">E-mail</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="E-mail" required>
            </div>

            <div>
                <label for="cpf" class="block text-gray-700 font-medium">CPF</label>
                <input type="text" name="cpf" id="cpf" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="CPF" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Senha</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Senha" required>
            </div>

            <div>
                <label for="confirm-password" class="block text-gray-700 font-medium">Confirmar Senha</label>
                <input type="password" name="confirm-password" id="confirm-password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Confirmar Senha" required>
            </div>

            <div>
                <label for="roles" class="block text-gray-700 font-medium">Função</label>
                <select name="roles[]" id="roles" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" multiple required>
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Salvar</button>
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
