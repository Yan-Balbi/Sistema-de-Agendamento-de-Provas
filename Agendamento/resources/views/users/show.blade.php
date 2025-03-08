@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-exibir-usuario.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Detalhes do Usuário</h1>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Nome:</label>
            <p class="text-lg text-gray-900">{{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">E-mail:</label>
            <p class="text-lg text-gray-900">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">CPF:</label>
            <p class="text-lg text-gray-900">{{ $user->cpf ?? 'Não informado' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Papél:</label>
            <div class="flex flex-wrap gap-2">
                @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $role)
                        <span class="bg-green-200 text-green-800 text-xs font-semibold px-2 py-1 rounded">{{ $role }}</span>
                    @endforeach
                @else
                    <p class="text-gray-600">Nenhum Papél atribuído</p>
                @endif
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>
@endsection
