@extends('layouts.app')
@section('content')
<div>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <label>Nome da sala</label>
    <form method="POST" action="{{ route('salas.update', $sala->id) }}">
        @csrf
        @method('PUT')
        <div>
            <input type="text" name="namee" placeholder="Digite o nome da sala" value="{{ $sala->nome }}" required>
        </div>
        <div>
            <button type="submit">Editar</button>
        </div>
    </form>
</div>
@endsection
