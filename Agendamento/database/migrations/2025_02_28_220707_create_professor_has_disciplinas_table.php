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
        Schema::create('professor_has_disciplinas', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professor_has_disciplinas');
    }
};
