<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix missing columns in empresa_concedentes
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'mantenedora')) {
                $table->string('mantenedora')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'email_secundario')) {
                $table->string('email_secundario')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'telefone_secundario')) {
                $table->string('telefone_secundario')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_estagio_formacao')) {
                $table->string('supervisor_estagio_formacao')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_estagio_cpf')) {
                $table->string('supervisor_estagio_cpf')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_estagio_email')) {
                $table->string('supervisor_estagio_email')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_estagio_telefone')) {
                $table->string('supervisor_estagio_telefone')->nullable();
            }
        });

        // Fix missing columns in instituicao_ensinos
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_cpf')) {
                $table->string('responsavel_legal_cpf')->nullable();
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_rg')) {
                $table->string('responsavel_legal_rg')->nullable();
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_email')) {
                $table->string('responsavel_legal_email')->nullable();
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_whatsapp')) {
                $table->string('responsavel_legal_whatsapp')->nullable();
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'email_secundario')) {
                $table->string('email_secundario')->nullable();
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'telefone_secundario')) {
                $table->string('telefone_secundario')->nullable();
            }
        });

        // Fix missing columns in seguradoras
        Schema::table('seguradoras', function (Blueprint $table) {
            if (!Schema::hasColumn('seguradoras', 'razao_social')) {
                $table->string('razao_social')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'cnpj')) {
                $table->string('cnpj')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'endereco')) {
                $table->string('endereco')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'bairro')) {
                $table->string('bairro')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'cidade')) {
                $table->string('cidade')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'estado')) {
                $table->string('estado', 2)->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'cep')) {
                $table->string('cep', 10)->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'arquivo_apolice')) {
                $table->string('arquivo_apolice')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_nome')) {
                $table->string('responsavel_legal_nome')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_cargo')) {
                $table->string('responsavel_legal_cargo')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_cpf')) {
                $table->string('responsavel_legal_cpf')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_rg')) {
                $table->string('responsavel_legal_rg')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_email')) {
                $table->string('responsavel_legal_email')->nullable();
            }
            if (!Schema::hasColumn('seguradoras', 'responsavel_legal_whatsapp')) {
                $table->string('responsavel_legal_whatsapp')->nullable();
            }
        });

        // Fix missing columns in agente_integracao
        Schema::table('agente_integracao', function (Blueprint $table) {
            if (!Schema::hasColumn('agente_integracao', 'responsavel_legal_cargo')) {
                $table->string('responsavel_legal_cargo')->nullable();
            }
            if (!Schema::hasColumn('agente_integracao', 'responsavel_legal_rg')) {
                $table->string('responsavel_legal_rg')->nullable();
            }
            if (!Schema::hasColumn('agente_integracao', 'responsavel_legal_email')) {
                $table->string('responsavel_legal_email')->nullable();
            }
            if (!Schema::hasColumn('agente_integracao', 'responsavel_legal_whatsapp')) {
                $table->string('responsavel_legal_whatsapp')->nullable();
            }
        });

        // Add new Representante Legal fields to ALL 4 tables
        $tablesForRepresentante = [
            'empresa_concedentes',
            'instituicao_ensinos',
            'seguradoras',
            'agente_integracao',
        ];

        foreach ($tablesForRepresentante as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'responsavel_legal_rg_orgao_emissor')) {
                    $table->string('responsavel_legal_rg_orgao_emissor')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_rg_uf')) {
                    $table->string('responsavel_legal_rg_uf', 2)->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_nacionalidade')) {
                    $table->string('responsavel_legal_nacionalidade')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_data_nascimento')) {
                    $table->date('responsavel_legal_data_nascimento')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_celular')) {
                    $table->string('responsavel_legal_celular')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_celular2')) {
                    $table->string('responsavel_legal_celular2')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_principal')) {
                    $table->boolean('responsavel_legal_principal')->nullable()->default(false);
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_ativo')) {
                    $table->boolean('responsavel_legal_ativo')->nullable()->default(true);
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_assina_documentos')) {
                    $table->boolean('responsavel_legal_assina_documentos')->nullable()->default(false);
                }
                if (!Schema::hasColumn($tableName, 'responsavel_legal_observacoes')) {
                    $table->text('responsavel_legal_observacoes')->nullable();
                }
            });
        }

        // Add new Supervisor fields to empresa_concedentes only
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_data_nascimento')) {
                $table->date('supervisor_data_nascimento')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_rg_orgao_emissor')) {
                $table->string('supervisor_rg_orgao_emissor')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_rg_uf')) {
                $table->string('supervisor_rg_uf', 2)->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_celular')) {
                $table->string('supervisor_celular')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_orgao_regulamentador')) {
                $table->string('supervisor_orgao_regulamentador')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_outras_formacoes')) {
                $table->text('supervisor_outras_formacoes')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_observacoes')) {
                $table->text('supervisor_observacoes')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_ativo')) {
                $table->boolean('supervisor_ativo')->nullable()->default(true);
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_setor')) {
                $table->string('supervisor_setor')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_matricula')) {
                $table->string('supervisor_matricula')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_acessa_processo_seletivo')) {
                $table->boolean('supervisor_acessa_processo_seletivo')->nullable();
            }
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_assina_documentos')) {
                $table->boolean('supervisor_assina_documentos')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $columns = [
                'mantenedora', 'email_secundario', 'telefone_secundario',
                'supervisor_estagio_formacao', 'supervisor_estagio_cpf',
                'supervisor_estagio_email', 'supervisor_estagio_telefone',
                'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf',
                'responsavel_legal_nacionalidade', 'responsavel_legal_data_nascimento',
                'responsavel_legal_celular', 'responsavel_legal_celular2',
                'responsavel_legal_principal', 'responsavel_legal_ativo',
                'responsavel_legal_assina_documentos', 'responsavel_legal_observacoes',
                'supervisor_data_nascimento', 'supervisor_rg_orgao_emissor', 'supervisor_rg_uf',
                'supervisor_celular', 'supervisor_orgao_regulamentador', 'supervisor_outras_formacoes',
                'supervisor_observacoes', 'supervisor_ativo', 'supervisor_setor',
                'supervisor_matricula', 'supervisor_acessa_processo_seletivo', 'supervisor_assina_documentos',
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('empresa_concedentes', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $columns = [
                'responsavel_legal_cpf', 'responsavel_legal_rg',
                'responsavel_legal_email', 'responsavel_legal_whatsapp',
                'email_secundario', 'telefone_secundario',
                'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf',
                'responsavel_legal_nacionalidade', 'responsavel_legal_data_nascimento',
                'responsavel_legal_celular', 'responsavel_legal_celular2',
                'responsavel_legal_principal', 'responsavel_legal_ativo',
                'responsavel_legal_assina_documentos', 'responsavel_legal_observacoes',
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('instituicao_ensinos', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        Schema::table('seguradoras', function (Blueprint $table) {
            $columns = [
                'razao_social', 'cnpj', 'endereco', 'bairro', 'cidade', 'estado', 'cep',
                'arquivo_apolice', 'responsavel_legal_nome', 'responsavel_legal_cargo',
                'responsavel_legal_cpf', 'responsavel_legal_rg',
                'responsavel_legal_email', 'responsavel_legal_whatsapp',
                'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf',
                'responsavel_legal_nacionalidade', 'responsavel_legal_data_nascimento',
                'responsavel_legal_celular', 'responsavel_legal_celular2',
                'responsavel_legal_principal', 'responsavel_legal_ativo',
                'responsavel_legal_assina_documentos', 'responsavel_legal_observacoes',
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('seguradoras', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        Schema::table('agente_integracao', function (Blueprint $table) {
            $columns = [
                'responsavel_legal_cargo', 'responsavel_legal_rg',
                'responsavel_legal_email', 'responsavel_legal_whatsapp',
                'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf',
                'responsavel_legal_nacionalidade', 'responsavel_legal_data_nascimento',
                'responsavel_legal_celular', 'responsavel_legal_celular2',
                'responsavel_legal_principal', 'responsavel_legal_ativo',
                'responsavel_legal_assina_documentos', 'responsavel_legal_observacoes',
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('agente_integracao', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
