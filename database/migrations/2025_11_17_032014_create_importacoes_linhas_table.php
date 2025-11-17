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
        Schema::create('importacoes_linhas_table_', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('importacao_id');
            $table->foreign('importacao_id')->references('id')->on('importacoes')->cascadeOnDelete();
           $table->string('nome');
           $table->string('cpf');
           $table->enum('tipo_acesso', ['professor', 'secretaria', 'coordenador','direcao','pendente'])->default('pendente'); 
           $table->string('email_institucional')->nullable();
           $table->string('telefone');
           $table->enum('status', ['sucesso', 'processando', 'erro'])->default('processando');
           $table->text('mensagem')->nullable();
           
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importacoes_linhas_table_');
    }
};
