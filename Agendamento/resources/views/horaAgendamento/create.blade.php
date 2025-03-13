@extends('layouts.app')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Adicionar Horário de Agendamento</h1>

        <form action="{{ route('hora-agendamento.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="hora_inicial" class="block text-gray-700 font-medium">Hora Inicial</label>
                <input type="time" name="hora_inicial" id="hora_inicial" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div>
                <label for="hora_final" class="block text-gray-700 font-medium">Hora Final</label>
                <input type="time" name="hora_final" id="hora_final" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition" required>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Salvar</button>
                <a href="{{ route('hora-agendamento.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
