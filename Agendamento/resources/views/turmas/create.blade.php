@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Nova Turma</h1>

    <form action="{{ route('turmas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-control" required>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="professors" class="form-label">Professores</label>
            <select name="professors[]" id="professors" class="form-control" multiple required>
                @foreach ($professors as $professor)
                    <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="disciplinas" class="form-label">Disciplinas</label>
            <select name="disciplinas[]" id="disciplinas" class="form-control" multiple required>
                @foreach ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
