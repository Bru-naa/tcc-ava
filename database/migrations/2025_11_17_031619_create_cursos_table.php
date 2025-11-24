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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
           $table->foreignId('escola_id')
    ->constrained('escolas')
    ->onDelete('cascade');
            $table->string('nome_curso');
            $table->text('descricao_curso')->nullable();
            $table->integer('duracao_curso'); // duração em meses
            $table->string('nivel_curso');
            $table->string('sigla');
            $table->integer('ultimo_numero')->default(0);
            $table->string('area_curso');
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso');
    }
};
