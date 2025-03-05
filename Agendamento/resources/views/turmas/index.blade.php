@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Turmas</h1>
    <a href="{{ route('turmas.create') }}" class="btn btn-primary mb-3">Adicionar Turma</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Professores</th>
                <th>Disciplinas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
                <tr>
                    <td>{{ $turma->nome }}</td>
                    <td>{{ $turma->curso->nome }}</td>
                    <td>
                        @foreach ($turma->professors as $professor)
                            <span class="badge bg-info">{{ $professor->nome }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($turma->disciplinas as $disciplina)
                            <span class="badge bg-secondary">{{ $disciplina->nome }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('turmas.destroy', $turma) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
