@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Turma</h1>

    <form action="{{ route('turmas.update', $turma) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $turma->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-control" required>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $turma->curso_id == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="professores" class="form-label">Professores</label>
            <select name="professores[]" id="professores" class="form-control" multiple required>
                @foreach ($professores as $professor)
                    <option value="{{ $professor->id }}"
                        {{ $turma->professores->contains($professor->id) ? 'selected' : '' }}>
                        {{ $professor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="disciplinas" class="form-label">Disciplinas</label>
            <select name="disciplinas[]" id="disciplinas" class="form-control" multiple required>
                @foreach ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}"
                        {{ $turma->disciplinas->contains($disciplina->id) ? 'selected' : '' }}>
                        {{ $disciplina->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
