@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Provas Agendadas</h1>
            <form method="GET" action="{{ route('home') }}" class="flex items-center">
                <label for="data_inicial" class="block text-lg font-medium text-gray-700 mr-2 whitespace-nowrap">Selecione a data:</label>
                <input type="date" id="data_inicial" name="data_inicial" value="{{ request('data_inicial', \Carbon\Carbon::today()->toDateString()) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-64 h-12 rounded-none rounded-l-md sm:text-lg border-gray-300 mr-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-lg font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-2">Buscar</button>
            </form>
        </div>

        @if($agendamentos->isEmpty())
            <p class="text-gray-500">Não há provas agendadas para a semana selecionada.</p>
        @else
            <form method="GET" action="{{ route('home') }}">
                <div class="mb-4">
                    <h2 class="text-lg font-medium text-gray-700">Selecione as disciplinas:</h2>
                    @foreach ($agendamentos->unique('disciplina_id') as $agendamento)
                        <div class="flex items-center">
                            <input type="checkbox" name="disciplinas[]" value="{{ $agendamento->disciplina_id }}" id="disciplina-{{ $agendamento->disciplina_id }}" class="mr-2">
                            <label for="disciplina-{{ $agendamento->disciplina_id }}" class="text-gray-700">{{ $agendamento->disciplina->nome }}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-lg font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filtrar</button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Horário</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Segunda-feira</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Terça-feira</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Quarta-feira</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Quinta-feira</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Sexta-feira</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Sábado</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider whitespace-nowrap">Domingo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($horarios as $horario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900 border bg-green-400">{{ $horario['hora_inicial'] }} - {{ $horario['hora_final'] }}</td>
                                @for ($i = 0; $i < 7; $i++)
                                    <td class="px-6 py-4 whitespace-nowrap border text-base">
                                        @foreach ($agendamentos->where('data', $dataInicial->copy()->addDays($i)->toDateString())->where('intervaloDeHora.hora_inicial', $horario['hora_inicial']) as $agendamento)
                                            @php
                                                $color = '';
                                                if (in_array($agendamento->disciplina_id, request('disciplinas', []))) {
                                                    $color = 'bg-blue-200'; // Você pode definir cores diferentes aqui
                                                }
                                            @endphp
                                            <div class="mb-2 p-2 border border-gray-200 rounded-lg {{ $color }}">
                                                <strong class="block text-base font-medium text-gray-700">{{ $agendamento->disciplina->nome }}</strong>
                                                <span class="block text-base text-gray-500">Sala: {{ $agendamento->sala->nome }}</span>
                                            </div>
                                        @endforeach
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
