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
        // users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('tema')->default(false);
          

              $table->string('email')->unique();


            $table->enum('status_ativacao', ['ativo', 'pendente'])->default('pendente');
            $table->foreignId('escola_id')->nullable()->constrained('escolas')->nullOnDelete();
           
           
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');


       
             $table->foreignId('role_id')->constrained()->onDelete('cascade');
        
        
            $table->rememberToken();
            $table->timestamps();
        });

        // password_reset_tokenss (padrão Laravel) — recomendo usar este nome
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // sessions (se você precisa armazenar sessões no DB)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('users')->nullOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};