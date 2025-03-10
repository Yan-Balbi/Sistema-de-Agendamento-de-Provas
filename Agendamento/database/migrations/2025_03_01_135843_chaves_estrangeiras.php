<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->foreign('intervalo_de_hora_de_agendamento_id')->references('id')->on('intervalo_de_hora_de_agendamentos')->onDelete('cascade');
            $table->foreign('intervalo_de_data_de_agendamento_id')->references('id')->on('intervalo_de_data_de_agendamentos')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
