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
        Schema::create('perguntas_avaliacao', function (Blueprint $table) {
             $table->id();
    $table->text('pergunta'); 
    $table->string('tipo');
    $table->json('opcoes')->nullable(); 
    $table->integer('ordem')->default(0);
    $table->boolean('ativo')->default(true);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas_avaliacao');
    }
};
