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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');
            $table->foreignId('intervalo_de_hora_de_agentamento_id')->references('id')->on('intervalo_de_hora_de_agentamentos')->onDelete('cascade');
            $table->foreignId('intervalo_de_data_de_agentamento_id')->references('id')->on('intervalo_de_data_de_agentamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
