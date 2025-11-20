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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
    $table->string('name'); // Secretaria, Professor, Coordenador, Direção
    $table->enum('acesso', ['admin', 'professor', 'coordenador','secretaria','direcao']); // nível de acesso
    $table->text('description')->nullable(); // descrição do papel
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
