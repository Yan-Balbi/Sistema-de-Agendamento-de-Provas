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
            $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');
            $table->foreignId('intervalo_de_hora_de_agentamento_id')->references('id')->on('intervalo_de_hora_de_agentamentos')->onDelete('cascade');
            $table->foreignId('intervalo_de_data_de_agentamento_id')->references('id')->on('intervalo_de_data_de_agentamentos')->onDelete('cascade');
            $table->foreignId('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        });

        Schema::table('turma_has_disciplinas', function (Blueprint $table) {
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
        });

        Schema::table('professor_has_disciplinas', function (Blueprint $table) {
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
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
