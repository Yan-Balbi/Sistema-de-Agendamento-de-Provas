@extends('layouts.app')

@section('content')
    <h1>Criar Curso</h1>
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Descrição:</label>
        <input type="text" name="descricao" required>
        <button type="submit">Salvar</button>
    </form>
@endsection
