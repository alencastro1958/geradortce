<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Campos extras para Instituições
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->string('mantenedora')->nullable()->after('razao_social');
        });

        // Campos extras para Empresas
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->string('responsavel_legal_cpf')->nullable()->after('responsavel_legal_nome');
            $table->string('responsavel_legal_rg')->nullable()->after('responsavel_legal_cpf');
            $table->string('responsavel_legal_email')->nullable()->after('responsavel_legal_cargo');
            $table->string('responsavel_legal_whatsapp')->nullable()->after('responsavel_legal_email');
            $table->boolean('autoriza_envio_mensagens')->default(true);
        });

        // Tabela de Vagas
        Schema::create('vagas', function (Blueprint $table) {
            $table->id(); // Este será o ID automático
            $table->string('codigo_vaga')->unique(); // ID amigável tipo VAG-0001
            $table->foreignId('empresa_id')->constrained('empresa_concedentes')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->string('area_atuacao');
            $table->decimal('bolsa_auxilio', 10, 2)->nullable();
            $table->string('horario');
            $table->boolean('ativa')->default(true);
            $table->timestamps();
        });

        // Tabela de Candidaturas
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaga_id')->constrained()->onDelete('cascade');
            $table->foreignId('estagiario_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pendente'); // pendente, aceita, recusada
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
        Schema::dropIfExists('vagas');
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn(['responsavel_legal_cpf', 'responsavel_legal_rg', 'responsavel_legal_email', 'responsavel_legal_whatsapp', 'autoriza_envio_mensagens']);
        });
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropColumn('mantenedora');
        });
    }
};
