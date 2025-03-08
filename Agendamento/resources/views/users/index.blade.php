@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-lista-usuarios.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Gerenciamento de Usuários</h1>
        @can('user-create')
            <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                <i class="fa fa-plus"></i> Criar Novo Usuário
            </a>
        @endcan
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mt-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse mt-5">
            <thead>
                <tr class="text-left text-gray-500 uppercase text-sm">
                    <th class="p-3">#</th>
                    <th class="p-3">Nome</th>
                    <th class="p-3">E-mail</th>
                    <th class="p-3">CPF</th>
                    <th class="p-3">Papél</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr class="bg-white border-b hover:bg-gray-100 transition">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 text-green-600 min-w-[200px]">{{ $user->name }}</td>
                        <td class="p-3 min-w-[250px]">{{ $user->email }}</td>
                        <td class="p-3 min-w-[150px]">{{ $user->cpf ?? 'N/A' }}</td>
                        <td class="p-3">
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $role)
                                    <span class="bg-green-200 text-green-800 text-xs font-semibold px-2 py-1 rounded">{{ $role }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                @can('user-update')
                                    <a href="{{ route('users.show', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                        <i class="fa-solid fa-list"></i> Ver
                                    </a>
                                @endcan
                                @can('user-update')
                                    <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>
                                @endcan
                                @can('user-delete')
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                            <i class="fa-solid fa-trash"></i> Excluir
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

<p class="text-center text-gray-500 mt-6 text-sm"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
