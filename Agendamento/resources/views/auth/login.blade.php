@ -1,63 +1,48 @@
@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        <h2 class="text-2xl font-semibold text-gray-800 text-center">Sistema de Agendamento de Prova</h2>

        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            <x-guest-layout>
                <x-authentication-card>
                    <x-slot name="logo">
                        <x-authentication-card-logo />
                    </x-slot>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>

                        <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
                        <input id="password" type="password" name="password" required
                            class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="remember_me" class="ms-2 text-sm text-gray-600">Lembrar-me</label>
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                    <!-- <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Esqueceu sua senha?</a> -->
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                    @endif

                                    <button type="submit" class="btn cadastrar">Entrar</button>
                                    <x-button class="ms-4">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                    </form>
    </div>
</div>
@endsection
</x-authentication-card>
</x-guest-layout>