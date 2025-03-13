@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Agendamento</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('CSS/estilo-cadastro-sala.css') }}" />
</head>
<div class="bg-gray-100 p-6">
    @if (session('success'))
        <p class="bg-green-100 border-l-4 border-green-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('success') }}</p>
    @elseif (session('error'))
        <p class="bg-red-100 border-l-4 border-red-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('error') }}</p>
    @elseif (session('warning'))
    <p class="bg-yellow-100 border-l-4 border-yellow-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('warning') }}</p>
    @endif
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 ">Agendamento de Horários</h2>
        <form action="{{ route('hora-agendamento.store') }}" method="POST" class="mt-4">
            @csrf
            <!-- Horário Inicial -->
            <label for="horario_inicial">Horário Inicial:</label>
            <input type="time" id="horario_inicial" name="hora_inicial" class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
            <br>

            <!-- Horário Final -->
            <label for="horario_final">Horário Final:</label>
            <input type="time" id="horario_final" name="hora_final" class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
            <br>

            <button type="submit" class="btn cadastrar">Cadastrar</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            // Preencher ComboBox de Horarios
            let horariosData = [];  // Variável para armazenar os dados de horários

            // Preencher ComboBox de Horarios
            $.get('/hora-agendamento/index-horarios', function (data) {
                data.forEach(horario => {
                    $('#horario').append(new Option(horario.hora_inicial + ' - ' + horario.hora_final, horario.id));
                });
                horariosData = data;  // Armazenar os dados de horários na variável global
                $('#horario').prop('disabled', false);
            });

            // Quando selecionar um horário, preencher os campos ocultos
            $('#horario').change(function () {
                let horarioId = $(this).val();
                let selectedHorario = horariosData.find(h => h.id == horarioId);  // Encontra o objeto correspondente ao horário selecionado

                if (selectedHorario) {
                    // Preencher os campos ocultos com os horários selecionados
                    $('#horario_inicial').val(selectedHorario.hora_inicial);
                    $('#horario_final').val(selectedHorario.hora_final);
                }
            });
        });
    </script>
@endsection
