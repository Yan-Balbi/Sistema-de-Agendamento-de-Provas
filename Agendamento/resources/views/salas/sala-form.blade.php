@extends('layouts.app')
@section('content')
<div>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <label>Nome da sala</label>
    <form method="POST" action="{{ route('salas.store') }}">
        @csrf
        <div>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome da sala" required>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
