@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-gerenciar-funcoes.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold text-gray-800">Gerenciamento de Papéis</h1>
            @can('role-create')
                <a href="{{ route('roles.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    <i class="fa fa-plus"></i> Criar Novo Papel
                </a>
            @endcan
        </div>

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
                    <th class="p-3">Permissões</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr class="bg-white border-b hover:bg-gray-100 transition">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 text-green-600 min-w-[200px]">{{ $role->name }}</td>
                        <td class="p-3 min-w-[250px]">
                            @if (!empty($role->permissions))
                                @php
                                    $permissionsList = $role->permissions->take(10); // Exibir apenas os primeiros 10
                                    $remaining = $role->permissions->count() - 10; // Contar permissões restantes
                                @endphp
                                @foreach ($permissionsList as $permission)
                                    <span class="bg-green-200 text-green-800 text-xs font-semibold px-2 py-1 rounded">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                                @if ($remaining > 0)
                                    <span class="bg-gray-300 text-gray-800 text-xs font-semibold px-2 py-1 rounded">
                                        +{{ $remaining }} mais...
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-600">Nenhuma permissão</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                @can('role-read')
                                    <a href="{{ route('roles.show', $role->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                        <i class="fa-solid fa-list"></i> Ver
                                    </a>
                                @endcan
                                @can('role-update')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>
                                @endcan
                                @can('role-delete')
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
            {!! $roles->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

<p class="text-center text-gray-500 mt-6 text-sm"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
