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
        Schema::create('turmas', function (Blueprint $table) {
           $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');

            $table->string('nome_turma');
            $table->enum('turno', ['matutino', 'vespertino', 'noturno']);
            $table->integer('ano_letivo');
            $table->enum('status', ['ativa', 'concluida', 'cancelada'])->default('ativa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
