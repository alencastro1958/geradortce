<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_cpf')) {
                $table->string('responsavel_legal_cpf')->nullable()->after('responsavel_legal_cargo');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_rg')) {
                $table->string('responsavel_legal_rg')->nullable()->after('responsavel_legal_cpf');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_email')) {
                $table->string('responsavel_legal_email')->nullable()->after('responsavel_legal_rg');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'responsavel_legal_whatsapp')) {
                $table->string('responsavel_legal_whatsapp')->nullable()->after('responsavel_legal_email');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'email_secundario')) {
                $table->string('email_secundario')->nullable()->after('email');
            }
            if (!Schema::hasColumn('instituicao_ensinos', 'telefone_secundario')) {
                $table->string('telefone_secundario')->nullable()->after('telefone');
            }
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'responsavel_legal_cpf')) {
                $table->string('responsavel_legal_cpf')->nullable()->after('responsavel_legal_cargo');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'responsavel_legal_rg')) {
                $table->string('responsavel_legal_rg')->nullable()->after('responsavel_legal_cpf');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'responsavel_legal_email')) {
                $table->string('responsavel_legal_email')->nullable()->after('responsavel_legal_rg');
            }
            
            if (Schema::hasColumn('empresa_concedentes', 'whatsapp')) {
                $table->renameColumn('whatsapp', 'responsavel_legal_whatsapp');
            } elseif (!Schema::hasColumn('empresa_concedentes', 'responsavel_legal_whatsapp')) {
                $table->string('responsavel_legal_whatsapp')->nullable()->after('responsavel_legal_email');
            }

            if (!Schema::hasColumn('empresa_concedentes', 'email_secundario')) {
                $table->string('email_secundario')->nullable()->after('email');
            }
            if (!Schema::hasColumn('empresa_concedentes', 'telefone_secundario')) {
                $table->string('telefone_secundario')->nullable()->after('telefone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropColumn([
                'responsavel_legal_cpf',
                'responsavel_legal_rg',
                'responsavel_legal_email',
                'responsavel_legal_whatsapp',
                'email_secundario',
                'telefone_secundario'
            ]);
        });

        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn([
                'responsavel_legal_cpf',
                'responsavel_legal_rg',
                'responsavel_legal_email',
                'responsavel_legal_whatsapp',
                'email_secundario',
                'telefone_secundario'
            ]);
        });
    }
};
