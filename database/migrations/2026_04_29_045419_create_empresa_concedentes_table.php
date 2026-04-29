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
        Schema::create('empresa_concedentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('cnpj')->unique();
            $table->string('razao_social');
            $table->string('nome_fantasia')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('responsavel_legal_nome')->nullable();
            $table->string('responsavel_legal_cargo')->nullable();
            $table->string('supervisor_estagio_nome')->nullable();
            $table->string('supervisor_estagio_cargo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_concedentes');
    }
};
