@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-cadastro-sala.css') }}" />
</head>

<div class="bg-gray-100 p-6">
    @if (session('success'))
    <p class="bg-green-100 border-l-4 border-green-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('success') }}</p>
    @elseif (session('error'))
    <p class="bg-red-100 border-l-4 border-red-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('error') }}</p>
    @elseif (session('warning'))
    <p class="bg-yellow-100 border-l-4 border-yellow-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('warning') }}</p>
    @endif

    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 text-center">Cadastro</h2>

        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <label for="name" class="block text-sm font-medium text-gray-700">Nome:</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">

            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
            <input id="cpf" type="text" name="cpf" value="{{ old('cpf') }}" maxlength="14" required
                class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">

            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">

            <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
            <input id="password" type="password" name="password" required
                class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">

            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme a senha:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="flex items-center mt-4">
                <input type="checkbox" name="terms" id="terms" required class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <label for="terms" class="ms-2 text-sm text-gray-600">
                    {!! __('Eu concordo com os :terms_of_service e :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">Termos de Serviço</a>',
                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">Política de Privacidade</a>',
                    ]) !!}
                </label>
            </div>
            @endif

            <script src="{{ asset('js/validacoes.js') }}"></script>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Já possui uma conta?</a>

                <button type="submit" class="btn cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection