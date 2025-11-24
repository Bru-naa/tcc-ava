<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_registros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cpf')->unique();
            $table->string('email_pessoal')->unique();
            
            $table->string('email_institucional')->unique();
            $table->string('criado_por')->nullable();
           
            
            $table->foreignId('escola_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pendente');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_registros');
    }
};