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
    Schema::create('reclamacoes', function (Blueprint $table) {
        $table->id();
        
        $table->string('assunto');
        $table->text('descricao');

        $table->string('status')->default('pendente');

        $table->timestamp('data_reclamacao')->useCurrent();
        $table->timestamp('data_resolucao')->nullable();

        $table->enum('prioridade', ['baixa', 'media', 'alta'])->default('media');

        // RELACIONAMENTOS
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('matricula_id')->constrained()->onDelete('cascade');
        $table->foreignId('escola_id')->constrained()->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamacoes');
    }
};
