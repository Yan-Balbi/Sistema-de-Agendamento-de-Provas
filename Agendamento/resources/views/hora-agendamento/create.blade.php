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
            // Preencher ComboBox de Cursos
            $.get('/agendamento/index-cursos', function (data) {
                data.forEach(curso => {
                    $('#curso').append(new Option(curso.nome, curso.id));
                });
            });

            // Quando selecionar um curso, carregar as turmas
            $('#curso').change(function () {
                let cursoId = $(this).val();
                $('#turma').html('<option value="">Selecione uma turma</option>').prop('disabled', cursoId === "");
                $('#professor').html('<option value="">Selecione um professor</option>').prop('disabled', true);
                $('#disciplina').html('<option value="">Selecione uma disciplina</option>').prop('disabled', true);

                if (cursoId) {
                    $.get('/agendamento/index-turmas', { cursoId: cursoId }, function (data) {
                        data.forEach(turma => {
                            $('#turma').append(new Option(turma.nome, turma.id));
                        });
                    });
                }
            });

            // Quando selecionar uma turma, carregar os professores
            $('#turma').change(function () {
                let turmaId = $(this).val();
                $('#professor').html('<option value="">Selecione um professor</option>').prop('disabled', turmaId === "");
                $('#disciplina').html('<option value="">Selecione uma disciplina</option>').prop('disabled', true);

                if (turmaId) {
                    $.get('/agendamento/index-professores', { turmaId: turmaId }, function (data) {
                        data.forEach(professor => {
                            $('#professor').append(new Option(professor.nome, professor.id));
                        });
                    });
                }
            });

            // Quando selecionar um professor, carregar as disciplinas
            $('#professor').change(function () {
                let professorId = $(this).val();
                let turmaId = $('#turma').val();
                $('#disciplina').html('<option value="">Selecione uma disciplina</option>').prop('disabled', professorId === "");

                if (professorId && turmaId) {
                    $.get('/agendamento/index-disciplinas', { professorId: professorId, turmaId: turmaId }, function (data) {
                        data.forEach(disciplina => {
                            $('#disciplina').append(new Option(disciplina.nome, disciplina.id));
                        });
                    });
                    $('#disciplina').prop('disabled', false);
                }
            });

            // Preencher ComboBox de Salas
            $.get('/agendamento/index-salas', function (data) {
                data.forEach(sala => {
                    $('#sala').append(new Option(sala.nome, sala.id));
                });
                $('#sala').prop('disabled', false);
            });
        });
    </script>
</div>
@endsection
