<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vagas', function (Blueprint $table) {
            if (!Schema::hasColumn('vagas', 'nome_empresa')) {
                $table->string('nome_empresa')->nullable()->after('empresa_id');
            }
            if (!Schema::hasColumn('vagas', 'cnpj_empresa')) {
                $table->string('cnpj_empresa', 32)->nullable()->after('nome_empresa');
            }
            if (!Schema::hasColumn('vagas', 'ramo_empresa')) {
                $table->string('ramo_empresa')->nullable()->after('cnpj_empresa');
            }
            if (!Schema::hasColumn('vagas', 'descricao_empresa')) {
                $table->text('descricao_empresa')->nullable()->after('ramo_empresa');
            }
            if (!Schema::hasColumn('vagas', 'endereco_empresa')) {
                $table->string('endereco_empresa')->nullable()->after('descricao_empresa');
            }
            if (!Schema::hasColumn('vagas', 'contato_empresa')) {
                $table->string('contato_empresa')->nullable()->after('endereco_empresa');
            }
            if (!Schema::hasColumn('vagas', 'email_empresa')) {
                $table->string('email_empresa')->nullable()->after('contato_empresa');
            }
            if (!Schema::hasColumn('vagas', 'telefone_empresa')) {
                $table->string('telefone_empresa')->nullable()->after('email_empresa');
            }
            if (!Schema::hasColumn('vagas', 'quantidade')) {
                $table->unsignedInteger('quantidade')->nullable()->after('area_atuacao');
            }
            if (!Schema::hasColumn('vagas', 'modalidade')) {
                $table->string('modalidade', 32)->nullable()->after('quantidade');
            }
            if (!Schema::hasColumn('vagas', 'cidade_estado')) {
                $table->string('cidade_estado')->nullable()->after('modalidade');
            }
            if (!Schema::hasColumn('vagas', 'inicio_previsto')) {
                $table->date('inicio_previsto')->nullable()->after('cidade_estado');
            }
            if (!Schema::hasColumn('vagas', 'formacao_aceita')) {
                $table->text('formacao_aceita')->nullable()->after('inicio_previsto');
            }
            if (!Schema::hasColumn('vagas', 'cursos')) {
                $table->text('cursos')->nullable()->after('formacao_aceita');
            }
            if (!Schema::hasColumn('vagas', 'periodo_minimo')) {
                $table->string('periodo_minimo')->nullable()->after('cursos');
            }
            if (!Schema::hasColumn('vagas', 'conhecimentos_desejaveis')) {
                $table->text('conhecimentos_desejaveis')->nullable()->after('periodo_minimo');
            }
            if (!Schema::hasColumn('vagas', 'competencias')) {
                $table->text('competencias')->nullable()->after('conhecimentos_desejaveis');
            }
            if (!Schema::hasColumn('vagas', 'atividades')) {
                $table->text('atividades')->nullable()->after('competencias');
            }
            if (!Schema::hasColumn('vagas', 'horas_dia')) {
                $table->string('horas_dia')->nullable()->after('atividades');
            }
            if (!Schema::hasColumn('vagas', 'dias')) {
                $table->string('dias')->nullable()->after('horas_dia');
            }
            if (!Schema::hasColumn('vagas', 'flexibilidade')) {
                $table->string('flexibilidade')->nullable()->after('horario');
            }
            if (!Schema::hasColumn('vagas', 'transporte')) {
                $table->string('transporte')->nullable()->after('bolsa_auxilio');
            }
            if (!Schema::hasColumn('vagas', 'alimentacao')) {
                $table->string('alimentacao')->nullable()->after('transporte');
            }
            if (!Schema::hasColumn('vagas', 'seguro')) {
                $table->string('seguro')->nullable()->after('alimentacao');
            }
            if (!Schema::hasColumn('vagas', 'outros_beneficios')) {
                $table->text('outros_beneficios')->nullable()->after('seguro');
            }
            if (!Schema::hasColumn('vagas', 'contratacao_tipo')) {
                $table->string('contratacao_tipo', 32)->nullable()->after('outros_beneficios');
            }
            if (!Schema::hasColumn('vagas', 'duracao')) {
                $table->string('duracao')->nullable()->after('contratacao_tipo');
            }
            if (!Schema::hasColumn('vagas', 'possibilidade_efetivacao')) {
                $table->string('possibilidade_efetivacao')->nullable()->after('duracao');
            }
            if (!Schema::hasColumn('vagas', 'etapas')) {
                $table->text('etapas')->nullable()->after('possibilidade_efetivacao');
            }
            if (!Schema::hasColumn('vagas', 'prazo')) {
                $table->date('prazo')->nullable()->after('etapas');
            }
            if (!Schema::hasColumn('vagas', 'retorno')) {
                $table->text('retorno')->nullable()->after('prazo');
            }
            if (!Schema::hasColumn('vagas', 'link_candidatura')) {
                $table->string('link_candidatura')->nullable()->after('retorno');
            }
            if (!Schema::hasColumn('vagas', 'email_candidatura')) {
                $table->string('email_candidatura')->nullable()->after('link_candidatura');
            }
            if (!Schema::hasColumn('vagas', 'instrucoes_candidatura')) {
                $table->text('instrucoes_candidatura')->nullable()->after('email_candidatura');
            }
            if (!Schema::hasColumn('vagas', 'observacoes')) {
                $table->text('observacoes')->nullable()->after('instrucoes_candidatura');
            }
        });

        DB::table('vagas')->update([
            'nome_empresa' => DB::raw('COALESCE(nome_empresa, (SELECT razao_social FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'cnpj_empresa' => DB::raw('COALESCE(cnpj_empresa, (SELECT cnpj FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'ramo_empresa' => DB::raw('COALESCE(ramo_empresa, (SELECT ramo_atividade FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'descricao_empresa' => DB::raw('COALESCE(descricao_empresa, descricao)'),
            'endereco_empresa' => DB::raw('COALESCE(endereco_empresa, (SELECT endereco FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'contato_empresa' => DB::raw('COALESCE(contato_empresa, (SELECT contato_nome FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'email_empresa' => DB::raw('COALESCE(email_empresa, (SELECT email FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'telefone_empresa' => DB::raw('COALESCE(telefone_empresa, (SELECT telefone FROM empresa_concedentes WHERE empresa_concedentes.id = vagas.empresa_id))'),
            'quantidade' => DB::raw('COALESCE(quantidade, 1)'),
            'modalidade' => DB::raw("COALESCE(modalidade, 'Presencial')"),
            'formacao_aceita' => DB::raw('COALESCE(formacao_aceita, area_atuacao)'),
            'atividades' => DB::raw('COALESCE(atividades, descricao)'),
            'horas_dia' => DB::raw("COALESCE(horas_dia, '6')"),
            'dias' => DB::raw("COALESCE(dias, 'Segunda a Sexta')"),
            'transporte' => DB::raw("COALESCE(transporte, 'A combinar')"),
            'alimentacao' => DB::raw("COALESCE(alimentacao, 'A combinar')"),
            'seguro' => DB::raw("COALESCE(seguro, 'Conforme política da empresa')"),
            'contratacao_tipo' => DB::raw("COALESCE(contratacao_tipo, 'Não obrigatório')"),
            'duracao' => DB::raw("COALESCE(duracao, 'A combinar')"),
            'possibilidade_efetivacao' => DB::raw("COALESCE(possibilidade_efetivacao, 'A combinar')")
        ]);
    }

    public function down(): void
    {
        Schema::table('vagas', function (Blueprint $table) {
            $columns = [
                'nome_empresa',
                'cnpj_empresa',
                'ramo_empresa',
                'descricao_empresa',
                'endereco_empresa',
                'contato_empresa',
                'email_empresa',
                'telefone_empresa',
                'quantidade',
                'modalidade',
                'cidade_estado',
                'inicio_previsto',
                'formacao_aceita',
                'cursos',
                'periodo_minimo',
                'conhecimentos_desejaveis',
                'competencias',
                'atividades',
                'horas_dia',
                'dias',
                'flexibilidade',
                'transporte',
                'alimentacao',
                'seguro',
                'outros_beneficios',
                'contratacao_tipo',
                'duracao',
                'possibilidade_efetivacao',
                'etapas',
                'prazo',
                'retorno',
                'link_candidatura',
                'email_candidatura',
                'instrucoes_candidatura',
                'observacoes',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('vagas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};