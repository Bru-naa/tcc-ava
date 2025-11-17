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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('alun_nome');
            $table->string('alun_email')->unique();
            $table->date('alun_data_nascimento');
            $table->string('alun_telefone');
            $table->string('alun_cpf');
            $table->string('alun_endereco');
            $table->enum('alun_sexo', ['masculino', 'feminino', 'outro']);
            $table->enum('status', ['ativo', 'transferido', 'concluido', 'inativo'])->default('ativo');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
