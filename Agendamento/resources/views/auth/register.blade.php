@extends('layouts.app')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/estilo-cadastro.css') }}" />
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 text-center">Cadastro</h2>
        @if ($errors->any())
        <div class="mb-4">
            <ul class="bg-red-100 text-red-700 p-4 rounded-lg">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name" class="block text-gray-700">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <label for="cpf" class="block text-gray-700">CPF</label>
                <input id="cpf" type="text" name="cpf" value="{{ old('cpf') }}" maxlength="14" required
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-gray-700">Senha</label>
                <input id="password" type="password" name="password" required
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-gray-700">Confirme a Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <label for="terms" class="flex items-center">
                    <input type="checkbox" name="terms" id="terms" required class="mr-2">
                    <span class="text-gray-700">
                        Eu concordo com os
                        <a href="{{ route('terms.show') }}" target="_blank" class="underline text-blue-600 hover:text-blue-800">Termos de Serviço</a>
                        e a
                        <a href="{{ route('policy.show') }}" target="_blank" class="underline text-blue-600 hover:text-blue-800">Política de Privacidade</a>.
                    </span>
                </label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Já está registrado?</a>

                <button type="submit" class="ms-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/validacoes.js') }}"></script>
@endsection