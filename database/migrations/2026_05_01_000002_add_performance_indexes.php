<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estagios', function (Blueprint $table) {
            $table->index(['estagiario_id', 'status']);
            $table->index(['empresa_concedente_id', 'status']);
            $table->index(['data_inicio', 'data_fim']);
        });

        Schema::table('documentos', function (Blueprint $table) {
            $table->index(['estagio_id', 'status']);
            $table->index(['tipo', 'status']);
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            $table->index(['cpf']);
            $table->index(['matricula']);
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->index(['cnpj']);
            $table->index(['cidade', 'estado']);
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->index(['cnpj']);
            $table->index(['cidade', 'estado']);
        });

        Schema::table('vagas', function (Blueprint $table) {
            $table->index(['empresa_id', 'ativa']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('estagios', function (Blueprint $table) {
            $table->dropIndex(['estagiario_id', 'status']);
            $table->dropIndex(['empresa_concedente_id', 'status']);
            $table->dropIndex(['data_inicio', 'data_fim']);
        });

        Schema::table('documentos', function (Blueprint $table) {
            $table->dropIndex(['estagio_id', 'status']);
            $table->dropIndex(['tipo', 'status']);
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            $table->dropIndex(['cpf']);
            $table->dropIndex(['matricula']);
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropIndex(['cnpj']);
            $table->dropIndex(['cidade', 'estado']);
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropIndex(['cnpj']);
            $table->dropIndex(['cidade', 'estado']);
        });

        Schema::table('vagas', function (Blueprint $table) {
            $table->dropIndex(['empresa_id', 'status']);
            $table->dropIndex(['created_at']);
        });
    }
};