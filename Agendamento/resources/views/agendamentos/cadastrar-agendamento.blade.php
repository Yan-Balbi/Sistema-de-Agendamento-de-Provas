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
    @elseif (session('eror'))
        <p class="bg-red-100 border-l-4 border-red-500 text-black-700 p-4 mb-4 rounded-lg">{{ session('success') }}</p>
    @endif
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 ">Cadastro de Agendamento de Provas</h2>
        <form method="POST" action="{{ route('agendamentos.store') }}">
            <!-- ComboBox de Cursos -->
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                <option value="">Selecione um curso</option>
            </select>
            <br>

            <!-- ComboBox de Turmas -->
            <label for="turma">Turma:</label>
            <select id="turma" name="turma" disabled class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                <option value="">Selecione uma turma</option>
            </select>
            <br>

            <!-- ComboBox de Professores -->
            <label for="professor">Professor:</label>
            <select id="professor" name="professor" disabled class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                <option value="">Selecione um professor</option>
            </select>
            <br>

            <!-- ComboBox de Disciplinas -->
            <label for="disciplina">Disciplina:</label>
            <select id="disciplina" name="disciplina" disabled class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                <option value="">Selecione uma disciplina</option>
            </select>
            <br>

            <div placeholder="Select date">
                <label for="birthday" >Data de agendamento:</label>
                <input type="date" id="birthday" name="birthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto ps-10 p-2.5">
            </div>
            <br>

            <!-- ComboBox de Horários -->
            <label for="disciplina">Horário:</label>
            <select id="horario" name="horario" disabled class="bg-gray-100 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-green-500 block w-full p-2.5">
                <option value="">Selecione um horario</option>
            </select>
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
                }
            });

            // Preencher ComboBox de Cursos
            $.get('/agendamento/index-horarios', function (data) {
                data.forEach(horario => {
                    $('#horario').append(new Option(horario.hora_inicial+' - '+horario.hora_final, horario.id));
                });
            });
        });
    </script>
</div>
@endsection
