<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            if (!Schema::hasColumn('instituicao_ensinos', 'logradouro')) {
                $table->string('logradouro')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'numero')) {
                $table->string('numero')->nullable()->after('logradouro');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'complemento')) {
                $table->string('complemento')->nullable()->after('numero');
            }
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'logradouro')) {
                $table->string('logradouro')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'numero')) {
                $table->string('numero')->nullable()->after('logradouro');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'complemento')) {
                $table->string('complemento')->nullable()->after('numero');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_formacao')) {
                $table->string('supervisor_formacao')->nullable()->after('supervisor_cargo');
            }
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            if (!Schema::hasColumn('estagiarios', 'logradouro')) {
                $table->string('logradouro')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('estagiarios', 'numero')) {
                $table->string('numero')->nullable()->after('logradouro');
            }
            if (!Schema::hasColumn('estagiarios', 'complemento')) {
                $table->string('complemento')->nullable()->after('numero');
            }
            if (!Schema::hasColumn('estagiarios', 'semestre_periodo_serie')) {
                $table->string('semestre_periodo_serie')->nullable()->after('curso');
            }
            if (!Schema::hasColumn('estagiarios', 'curso_data_inicio')) {
                $table->string('curso_data_inicio')->nullable()->after('semestre_periodo_serie');
            }
            if (!Schema::hasColumn('estagiarios', 'curso_data_conclusao_prevista')) {
                $table->string('curso_data_conclusao_prevista')->nullable()->after('curso_data_inicio');
            }
            if (!Schema::hasColumn('estagiarios', 'periodo')) {
                $table->string('periodo')->nullable()->after('semestre_atual');
            }
        });

        Schema::table('seguradoras', function (Blueprint $table) {
            if (!Schema::hasColumn('seguradoras', 'logradouro')) {
                $table->string('logradouro')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('seguradoras', 'numero')) {
                $table->string('numero')->nullable()->after('logradouro');
            }
            if (!Schema::hasColumn('seguradoras', 'complemento')) {
                $table->string('complemento')->nullable()->after('numero');
            }
            if (!Schema::hasColumn('seguradoras', 'telefone')) {
                $table->string('telefone')->nullable()->after('cep');
            }
            if (!Schema::hasColumn('seguradoras', 'email')) {
                $table->string('email')->nullable()->after('telefone');
            }
            if (!Schema::hasColumn('seguradoras', 'valor_cobertura')) {
                $table->decimal('valor_cobertura', 10, 2)->nullable()->after('apolice_numero');
            }
            if (!Schema::hasColumn('seguradoras', 'capital_segurado')) {
                $table->decimal('capital_segurado', 10, 2)->nullable()->after('valor_cobertura');
            }
            if (!Schema::hasColumn('seguradoras', 'inicio_vigencia')) {
                $table->date('inicio_vigencia')->nullable()->after('capital_segurado');
            }
            if (!Schema::hasColumn('seguradoras', 'fim_vigencia')) {
                $table->date('fim_vigencia')->nullable()->after('inicio_vigencia');
            }
            if (!Schema::hasColumn('seguradoras', 'susep_vida_em_grupo')) {
                $table->string('susep_vida_em_grupo')->nullable()->after('fim_vigencia');
            }
            if (!Schema::hasColumn('seguradoras', 'susep_acidentes_pessoais')) {
                $table->string('susep_acidentes_pessoais')->nullable()->after('susep_vida_em_grupo');
            }
            if (!Schema::hasColumn('seguradoras', 'capital_morte_acidental')) {
                $table->decimal('capital_morte_acidental', 10, 2)->nullable()->after('susep_acidentes_pessoais');
            }
            if (!Schema::hasColumn('seguradoras', 'capital_morte_acidental_extenso')) {
                $table->string('capital_morte_acidental_extenso')->nullable()->after('capital_morte_acidental');
            }
        });
    }

    public function down(): void
    {
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropColumn(['logradouro', 'numero', 'complemento']);
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn(['logradouro', 'numero', 'complemento', 'supervisor_formacao']);
        });

        Schema::table('estagiarios', function (Blueprint $table) {
            $table->dropColumn([
                'logradouro',
                'numero',
                'complemento',
                'semestre_periodo_serie',
                'curso_data_inicio',
                'curso_data_conclusao_prevista',
                'periodo'
            ]);
        });

        Schema::table('seguradoras', function (Blueprint $table) {
            $table->dropColumn([
                'logradouro',
                'numero',
                'complemento',
                'telefone',
                'email',
                'valor_cobertura',
                'capital_segurado',
                'inicio_vigencia',
                'fim_vigencia',
                'susep_vida_em_grupo',
                'susep_acidentes_pessoais',
                'capital_morte_acidental',
                'capital_morte_acidental_extenso'
            ]);
        });
    }
};
