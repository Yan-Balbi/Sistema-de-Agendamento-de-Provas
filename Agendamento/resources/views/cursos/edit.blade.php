@extends('layouts.app')

@section('content')
    <h1>Editar Curso</h1>
    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nome:</label>
        <input type="text" name="nome" value="{{ $curso->nome }}" required>
        <label>Descrição:</label>
        <input type="text" name="descricao" value="{{ $curso->descricao }}" required>
        <button type="submit">Salvar</button>
    </form>
@endsection
