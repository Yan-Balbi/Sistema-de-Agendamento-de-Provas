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
