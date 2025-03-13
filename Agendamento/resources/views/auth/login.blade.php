@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/estilo-login.css') }}" />
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 text-center">Login</h2>

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-4">
            <ul class="bg-red-100 text-red-700 p-4 rounded-lg">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-gray-700">Senha</label>
                <input id="password" type="password" name="password" required
                    class="block mt-1 w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-600">Lembrar-me</span>
                </label>
            </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection