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
        Schema::create('turma_has_disciplinas', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('turma_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
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
