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
        Schema::create('estagiarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('curso')->nullable();
            $table->integer('semestre_atual')->nullable();
            $table->string('matricula')->nullable();
            $table->string('responsavel_legal_nome')->nullable();
            $table->string('responsavel_legal_cpf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estagiarios');
    }
};
