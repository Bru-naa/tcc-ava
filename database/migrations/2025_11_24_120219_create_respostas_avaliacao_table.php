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
        Schema::create('respostas_avaliacao', function (Blueprint $table) {
             $table->id();
    $table->foreignId('pergunta_id')->constrained('perguntas_avaliacao');
    $table->string('periodo'); 
    $table->string('resposta'); 
    $table->string('session_id'); 
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas_avaliacao');
    }
};
