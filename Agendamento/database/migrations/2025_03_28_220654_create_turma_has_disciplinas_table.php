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
       // Migração para 'turma_has_disciplinas'
Schema::create('turma_has_disciplinas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('turma_id')->constrained()->onDelete('cascade');
    $table->foreignId('disciplina_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turma_has_disciplinas');
    }
};
