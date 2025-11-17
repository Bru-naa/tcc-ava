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
        Schema::create('escolas', function (Blueprint $table) {
           $table->id();
            $table->string('esc_nome');
            $table->string('esc_endereco');
            $table->string('esc_telefone');
            $table->string('esc_email')->unique();
            $table->string('esc_codigo')->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('esc_tipo');

            $table->unsignedBigInteger('regional_id');
            $table->foreign('regional_id')->references('id')->on('regionais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escolas');
    }
};
