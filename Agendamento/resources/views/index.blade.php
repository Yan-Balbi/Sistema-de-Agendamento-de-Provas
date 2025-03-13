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
            <button id="toggleDisciplinas" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-lg font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Selecionar Disciplinas</button>
            <form method="GET" action="{{ route('home') }}" id="disciplinasForm" class="hidden transition-all duration-500 ease-in-out max-h-0 overflow-hidden bg-gray-100 p-4 rounded-md shadow-md">
                <div class="mb-4">
                    <h2 class="text-lg font-medium text-gray-700 mb-2">Disciplinas agendadas nesta semana:</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($agendamentos->unique('disciplina_id') as $index => $agendamento)
                            @php
                                $colors = ['bg-blue-200', 'bg-red-200', 'bg-yellow-200', 'bg-green-200', 'bg-purple-200', 'bg-pink-200', 'bg-indigo-200'];
                                $color = $colors[$agendamento->disciplina_id % count($colors)];
                            @endphp
                            <label for="disciplina-{{ $agendamento->disciplina_id }}" class="flex items-center bg-white p-2 rounded-md shadow-sm border border-gray-200 cursor-pointer {{ in_array($agendamento->disciplina_id, request('disciplinas', [])) ? $color : '' }}">
                                <input type="checkbox" name="disciplinas[]" value="{{ $agendamento->disciplina_id }}" id="disciplina-{{ $agendamento->disciplina_id }}" class="mr-2 h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" {{ in_array($agendamento->disciplina_id, request('disciplinas', [])) ? 'checked' : '' }} onchange="this.parentElement.classList.toggle('{{ $color }}', this.checked)">
                                <span class="text-gray-700">{{ $agendamento->disciplina->nome }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-lg font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Destacar</button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead style="background-color: #034811;">
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
                                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-white border" style="background-color: #046b1c;">
                                    {{ \Carbon\Carbon::parse($horario['hora_inicial'])->format('H:i') }} - {{ \Carbon\Carbon::parse($horario['hora_final'])->format('H:i') }}
                                </td>
                                @for ($i = 0; $i < 7; $i++)
                                    <td class="px-6 py-4 whitespace-nowrap border text-base">
                                        @foreach ($agendamentos->where('data', $dataInicial->copy()->addDays($i)->toDateString())->where('intervaloDeHora.hora_inicial', $horario['hora_inicial']) as $agendamento)
                                            @php
                                                $colors = ['bg-blue-200', 'bg-red-200', 'bg-yellow-200', 'bg-green-200', 'bg-purple-200', 'bg-pink-200', 'bg-indigo-200'];
                                                $color = '';
                                                if (in_array($agendamento->disciplina_id, request('disciplinas', []))) {
                                                    $color = $colors[$agendamento->disciplina_id % count($colors)];
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

    <script>
        document.getElementById('toggleDisciplinas').addEventListener('click', function() {
            var form = document.getElementById('disciplinasForm');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                form.style.maxHeight = form.scrollHeight + "px";
            } else {
                form.style.maxHeight = "0";
                form.addEventListener('transitionend', function() {
                    form.classList.add('hidden');
                }, { once: true });
            }
        });
    </script>
@endsection