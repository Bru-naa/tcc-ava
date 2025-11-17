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
        Schema::create('regionais', function (Blueprint $table) {
              $table->id();
            $table->string('reg_nome');
            $table->string('reg_codigo')->unique();
            $table->string('reg_telefone');
            $table->string('reg_email')->unique();
            $table->string('reg_endereco');
            $table->string('reg_cidade');
            $table->string('reg_estado');
            $table->string('reg_responsavel_nome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regionais');
    }
};
