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
        Schema::create('status_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->boolean('aberta')->default(false);
            $table->string('aberto_por');
            $table->string('fechado_por')->nullable();
            $table->date('data_abertura')->nullable();
            $table->date('data_fechamento')->nullable();
            $table->string('observacoes')->nullable();
            $table->string('periodo')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_avaliacoes');
    }
};
