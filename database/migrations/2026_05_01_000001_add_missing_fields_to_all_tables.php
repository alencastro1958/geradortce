<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'contato_nome')) {
                $table->string('contato_nome')->nullable()->after('email');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'ramo_atividade')) {
                $table->string('ramo_atividade')->nullable()->after('contato_nome');
            }
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            if (!Schema::hasColumn('instituicao_ensinos', 'contato_nome')) {
                $table->string('contato_nome')->nullable()->after('email');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'tipo_instituicao')) {
                $table->string('tipo_instituicao')->nullable()->after('contato_nome');
            }
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            if (!Schema::hasColumn('estagiarios', 'nacionalidade')) {
                $table->string('nacionalidade')->nullable()->after('estado');
            }
            if (!Schema::hasColumn('estagiarios', 'nome_mae')) {
                $table->string('nome_mae')->nullable()->after('nacionalidade');
            }
        });

        Schema::table('seguradoras', function (Blueprint $table) {
            if (!Schema::hasColumn('seguradoras', 'cnpj')) {
                $table->string('cnpj')->nullable()->unique()->after('nome');
            }
            if (!Schema::hasColumn('seguradoras', 'contato_nome')) {
                $table->string('contato_nome')->nullable()->after('cnpj');
            }
            if (!Schema::hasColumn('seguradoras', 'endereco')) {
                $table->string('endereco')->nullable()->after('contato_nome');
            }
        });
    }

    public function down(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn(['contato_nome', 'ramo_atividade']);
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropColumn(['contato_nome', 'tipo_instituicao']);
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            $table->dropColumn(['nacionalidade', 'nome_mae']);
        });

        Schema::table('seguradoras', function (Blueprint $table) {
            $table->dropColumn(['cnpj', 'contato_nome', 'endereco']);
        });
    }
};