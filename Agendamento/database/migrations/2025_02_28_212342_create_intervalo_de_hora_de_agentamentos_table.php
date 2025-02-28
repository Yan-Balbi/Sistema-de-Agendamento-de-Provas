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
        Schema::create('intervalo_de_hora_de_agentamentos', function (Blueprint $table) {
            $table->id();
            $table->date('hora_inicial');
            $table->date('hora_final');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervalo_de_hora_de_agentamentos');
    }
};
