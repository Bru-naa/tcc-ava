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
        Schema::create('matriculas', function (Blueprint $table) {
              $table->id();
            
              $table->string('codigo_matricula')->unique();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
           
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');

            $table->foreignId('turma_id')
      ->nullable()
      ->constrained('turmas')
      ->onDelete('cascade');
              
            $table->date('data_matricula');
            $table->enum('status', ['ativa', 'trancada', 'concluida', 'transferido'])->default('ativa');
            $table->timestamps();// quando foi criada e atualizada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
